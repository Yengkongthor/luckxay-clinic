<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DoctorMedicine\IndexDoctorMedicine;
use App\Http\Requests\Admin\ExamPackage\BulkDestroyExamPackage;
use App\Http\Requests\Admin\ExamPackage\DestroyExamPackage;
use App\Http\Requests\Admin\ExamPackage\IndexExamPackage;
use App\Http\Requests\Admin\ExamPackage\StoreExamPackage;
use App\Http\Requests\Admin\ExamPackage\UpdateExamPackage;
use App\Models\DoctorMedicine;
use App\Models\Employee;
use App\Models\ExamPackage;
use App\Models\Medicine;
use App\Models\PrescribeMedicine;
use App\Models\Upload;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Log;

class ExamPackagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexExamPackage $request
     * @return array|Factory|View
     */
    public function index(IndexExamPackage $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ExamPackage::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['employee_id', 'id', 'package_id', 'status'],

            // set columns to searchIn
            ['id', 'status'],
            static function (Builder $query) {
                $query->where('employee_id', null);
            }
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        $dataEmployeeStatus = DB::table('employee_statuses')
            ->select(['employee_statuses.status', 'employees.position', 'employees.id', DB::raw('CONCAT(lao_first_name," ",lao_last_name) AS lao_full_name')])
            ->join('employees', 'employees.id', '=', 'employee_statuses.employee_id')
            // ->where('queue_id', null)
            ->where('status', true)
            ->where('employees.position', 'Doctor')
            ->get();

        // return $data;
        return view('admin.exam-package.index', ['data' => $data, 'doctors' => $dataEmployeeStatus]);
    }


    /**
     * Display a listing of the resource.
     *
     * @param IndexDoctorMedicine $request
     * @return array|Factory|View
     */
    public function indexDoctorMedicine(IndexDoctorMedicine $request, $patientHistoryId)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(DoctorMedicine::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['amount', 'cheminal_name', 'id', 'patient_history_id'],

            // set columns to searchIn
            ['cheminal_name', 'id'],
            static function (Builder $query) use ($patientHistoryId) {
                $query->where('patient_history_id', $patientHistoryId);
            }
        );

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
        $this->authorize('admin.exam-package.create');

        return view('admin.exam-package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExamPackage $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreExamPackage $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the ExamPackage
        $examPackage = ExamPackage::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/exam-packages'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/exam-packages');
    }

    /**
     * Display the specified resource.
     *
     * @param ExamPackage $examPackage
     * @throws AuthorizationException
     * @return void
     */
    public function show(ExamPackage $examPackage)
    {
        $this->authorize('admin.exam-package.show', $examPackage);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ExamPackage $examPackage
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(ExamPackage $examPackage, IndexDoctorMedicine $request)
    {
        $this->authorize('admin.exam-package.edit', $examPackage);
        // $upload = Upload::wherePatientHistoryId($examPackage->patientHistory->patient_historyable_id)->get();

        return view('admin.exam-package.edit', [
            'examPackage' => $examPackage,
            // 'upload' => $upload,
            'data' => $this->indexDoctorMedicine($request, $examPackage->patientHistory->id),
            'medicines' => Medicine::all(),
            'patientHistoryId' => $examPackage->patientHistory->id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateExamPackage $request
     * @param ExamPackage $examPackage
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateExamPackage $request, ExamPackage $examPackage)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        //
        // Update changed values ExamPackage
        $examPackage->update($sanitized);

        $examPackage->comments()->create($sanitized);

        $prescribeMedicine = PrescribeMedicine::wherePatientHistoryId($examPackage->patientHistory->id)->first();
        $prescribeMedicine->employee_queue = Employee::find($request->employee_id)->lao_first_name;
        $prescribeMedicine->save();

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/examinations'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/examinations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyExamPackage $request
     * @param ExamPackage $examPackage
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyExamPackage $request, ExamPackage $examPackage)
    {
        $examPackage->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyExamPackage $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyExamPackage $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    ExamPackage::whereIn('id', $bulkChunk)->delete();
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
