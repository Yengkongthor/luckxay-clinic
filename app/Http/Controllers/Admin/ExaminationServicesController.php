<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExaminationService\BulkDestroyExaminationService;
use App\Http\Requests\Admin\ExaminationService\DestroyExaminationService;
use App\Http\Requests\Admin\ExaminationService\IndexExaminationService;
use App\Http\Requests\Admin\ExaminationService\StoreExaminationService;
use App\Http\Requests\Admin\ExaminationService\UpdateExaminationService;
use App\Http\Requests\Admin\PatientHistory\IndexPatientHistory;
use App\Http\Requests\Admin\Queue\IndexQueue;
use App\Models\DoctorMedicine;
use App\Models\ExaminationService;
use App\Models\PatientHistory;
use App\Models\Queue;
use App\Models\Upload;
use Auth;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Log;

class ExaminationServicesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexPatientHistory $request
     * @return array|Factory|View
     */
    public function getPatientHistoryExamination(IndexQueue $request)
    {


        return view('admin.examination-service.index', [
            'data_examination' => $this->getPateintExaminationService($request, 'examination'),
            'data_input_again' => $this->getPateintExaminationService($request, 'input')
        ]);
    }

    public function getPateintExaminationService(IndexQueue $request, $status)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ExaminationService::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['lab_detail_id', 'lab_id', 'patient_history_id', 'service_id', 'value',],

            // set columns to searchIn
            ['id'],
            static function (Builder $query) use ($status) {
                if ($status == 'input') {
                    $query->where('input_status', 1);
                }
            }

        );

        if ($status == 'examination') {
            $examinationService =  ExaminationService::whereIn('lab_id', Auth()->user()->employee->lab_id)->whereValue(null)->get()->pluck('patient_history_id');
            $patientExamnation = PatientHistory::whereIn('id', $examinationService)->get();
        }

        if ($status == 'input') {
            $examinationService =  ExaminationService::whereIn('lab_id', Auth()->user()->employee->lab_id)->where('input_status', 1)->get()->pluck('patient_history_id');
            $patientExamnation = PatientHistory::whereIn('id', $examinationService)->get();
        }



        $data = collect($data);
        $data['data'] = [
            'data_examination' => $data['data'],
            'patientExamnation' => $patientExamnation,
        ];

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.examination-service.create');

        return view('admin.examination-service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExaminationService $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreExaminationService $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the ExaminationService
        $examinationService = ExaminationService::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/examination-services'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/examination-services');
    }

    /**
     * Display the specified resource.
     *
     * @param ExaminationService $examinationService
     * @throws AuthorizationException
     * @return void
     */
    public function show(ExaminationService $examinationService)
    {
        $this->authorize('admin.examination-service.show', $examinationService);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ExaminationService $examinationService
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(ExaminationService $examinationService)
    {
        $this->authorize('admin.examination-service.edit', $examinationService);


        return view('admin.examination-service.edit', [
            'examinationService' => $examinationService,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateExaminationService $request
     * @param ExaminationService $examinationService
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateExaminationService $request, ExaminationService $examinationService)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values ExaminationService
        $examinationService->update($sanitized);

        $updateStatus = ExaminationService::wherePatientHistoryId($examinationService->patient_history_id)->whereValue(null)->first();

        if (!$updateStatus) {
            $patientHistory = PatientHistory::find($examinationService->patient_history_id);
            $patientHistory->status = true;
            $patientHistory->save();
            // TODO: Notificaion examination_result
        }

        if ($request->ajax()) {
            return [
                'redirect' => url('/admin/examination-services/view/' . $examinationService->patient_history_id),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/examination-services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyExaminationService $request
     * @param ExaminationService $examinationService
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyExaminationService $request, ExaminationService $examinationService)
    {
        $examinationService->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyExaminationService $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyExaminationService $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    ExaminationService::whereIn('id', $bulkChunk)->delete();
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    public function view(Request $request, $patientHistoryId)
    {
        $upload = Upload::wherePatientHistoryId($patientHistoryId)->whereEmployeeId(auth()->user()->employee->id)->get();
        $PatientHistory = PatientHistory::find($patientHistoryId);
        // return  $this->getExaminationService($request);
        return view('admin.examination-service-view.index', [
            'data' => $this->getExaminationService($request),
            'upload' => $upload,
            'patientHistoryId' => $patientHistoryId,
            'patientHistory' => $PatientHistory,
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @param IndexExaminationService $request
     * @return array|Factory|View
     */
    public function getExaminationService(Request $request)
    {
        $request['per_page'] = 1000;
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ExaminationService::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'patient_history_id', 'service_id', 'lab_id', 'lab_detail_id', 'value'],

            // set columns to searchIn
            ['id'],
            static function (Builder $query) use ($request) {
                $query->with(['lab', 'labDetail', 'service']);

                $query->where('patient_history_id', $request->patientHistoryId);

                $query->whereIn('lab_id', Auth::user()->employee ? Auth::user()->employee->lab_id : null);

                if ($request->input == 1) {
                    $query->where('input_status', 1);
                }
            }
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }


        return $data;
    }

    public function updateExaminationService(Request $request)
    {
        foreach ($request->value as $key => $value) {
            $examinationService = ExaminationService::wherePatientHistoryId($request->patient_history_id)->whereLabDetailId($key)->first();
            if ($examinationService) {
                $examinationService->value = $value;
                $examinationService->input_status = 1;
                $examinationService->save();
            }

            $updateStatus = ExaminationService::wherePatientHistoryId($request->patient_history_id)->whereValue(null)->first();


            if (!$updateStatus) {
                $patientHistory = PatientHistory::find($examinationService->patient_history_id);
                $patientHistory->status = true;
                $patientHistory->save();
                // TODO: Notificaion examination_result
            }
        }

        // Sanitize input
        $sanitized = ['employee_id' => $request->employee_id, 'patient_history_id' => $request->patient_history_id];

        $upload = Upload::whereEmployeeId($request->employee_id)->wherePatientHistoryId($request->patient_history_id)->first();

        if ($upload) {
            if ($request->file('upload_file')) {
                $upload->clearMediaCollection('upload_file');

                foreach ($request->file('upload_file') as $key => $file) {
                    $upload->addMedia($file)->toMediaCollection('upload_file');
                }
            }
        } else {
            $upload = Upload::create($sanitized);
            if ($upload) {
                if ($request->file('upload_file')) {
                    foreach ($request->file('upload_file') as $key => $file) {
                        $upload->addMedia($file)->toMediaCollection('upload_file');
                    }
                }
            }
        }





        $doctor_medicine = DoctorMedicine::wherePatientHistoryId($request->patient_history_id)->first();

        if ($doctor_medicine) {
            $doctor_medicine->delete();
        }

        return redirect('admin/examination-services');
    }
}
