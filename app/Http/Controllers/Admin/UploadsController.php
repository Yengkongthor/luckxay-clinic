<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Upload\BulkDestroyUpload;
use App\Http\Requests\Admin\Upload\DestroyUpload;
use App\Http\Requests\Admin\Upload\IndexUpload;
use App\Http\Requests\Admin\Upload\StoreUpload;
use App\Http\Requests\Admin\Upload\UpdateUpload;
use App\Models\DoctorMedicine;
use App\Models\PatientHistory;
use App\Models\Queue;
use App\Models\Upload;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Log;

class UploadsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexUpload $request
     * @return array|Factory|View
     */
    public function index(IndexUpload $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Upload::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'lab_id', 'patient_history_id'],

            // set columns to searchIn
            ['id']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.upload.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.upload.create');

        return view('admin.upload.create');
    }

    /**ted resource in storage.
     *
     * @param StoreUp
     * Store a newly creaload $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreUpload $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();


        $upload = Upload::create($sanitized);



        $doctor_medicine = DoctorMedicine::wherePatientHistoryId($request->patient_history_id)->first();

        if ($doctor_medicine) {
            $doctor_medicine->delete();
        }

        if ($request->ajax()) {
            return ['redirect' => url('admin/examination-services'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/uploads');
    }

    /**
     * Display the specified resource.
     *
     * @param Upload $upload
     * @throws AuthorizationException
     * @return void
     */
    public function show(Upload $upload)
    {
        $this->authorize('admin.upload.show', $upload);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Upload $upload
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Upload $upload)
    {
        $this->authorize('admin.upload.edit', $upload);


        return view('admin.upload.edit', [
            'upload' => $upload,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUpload $request
     * @param Upload $upload
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateUpload $request, Upload $upload)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Upload
        $upload->update($sanitized);

        // $patientHistory = PatientHistory::find($upload->patient_history_id);

        // $queue = Queue::find($patientHistory->patient_historyable_id);

        // $queue->queues_status = 'examination_result';
        if ($request->ajax()) {
            return [
                'redirect' => url('admin/examination-services'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }
        // TODO:queue Status = examination_reult
        return redirect('admin/uploads');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyUpload $request
     * @param Upload $upload
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyUpload $request, Upload $upload)
    {
        $upload->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyUpload $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyUpload $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Upload::whereIn('id', $bulkChunk)->delete();
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
