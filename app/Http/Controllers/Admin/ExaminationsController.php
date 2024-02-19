<?php

namespace App\Http\Controllers\Admin;

use App\Events\DoctorOnline;
use App\Events\SendToLab;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Examination\BulkDestroyExamination;
use App\Http\Requests\Admin\Examination\DestroyExamination;
use App\Http\Requests\Admin\Examination\IndexExamination;
use App\Http\Requests\Admin\Examination\StoreExamination;
use App\Http\Requests\Admin\Examination\UpdateExamination;
use App\Http\Requests\Admin\PatientHistory\IndexPatientHistory;
use App\Http\Requests\Admin\PatientHistory\StorePatientHistory;
use App\Http\Requests\Admin\Queue\IndexQueue;
use App\Models\EmployeeStatus;
use App\Models\Examination;
use App\Models\ExamPackage;
use App\Models\InformationHistoryDetail;
use App\Models\Lab;
use App\Models\LabDetail;
use App\Models\PatientHistory;
use App\Models\PrescribeMedicine;
use App\Models\PrescribeMedicineDetail;
use App\Models\Queue;
use App\Models\Service;
use Arr;
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

class ExaminationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexExamination $request
     * @return array|Factory|View
     */
    public function index(IndexQueue $request)
    {
        $employeeStatus = EmployeeStatus::whereEmployeeId(auth()->user()->employee->id)->first();

        return view('admin.examination.index', [
            'data' => $this->indexStatus($request, 'processing'),
            'dataWait' => $this->indexStatus($request, 'wait'),
            'dataExamination' => $this->indexStatus($request, 'examination'),
            'dataExaminationResult' => $this->indexStatus($request, 'examination_result'),
            'dataExamPackage' => $this->indexExamPackage($request),
            'wait_count' => Queue::where('queues_status', 'wait')->count(),
            'exam_package_wait_count' => ExamPackage::whereEmployeeId(auth()->user()->employee ? auth()->user()->employee->id : null)->count(),
            'assign' => $employeeStatus ? $employeeStatus->assign : 0,
        ]);
    }


    public function indexExamPackage(IndexQueue $request)
    {
        $request['per_page'] = 100;
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ExamPackage::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['employee_id', 'id', 'package_id', 'status'],

            // set columns to searchIn
            ['id', 'status'],
            static function (Builder $query) {
                $query->where('employee_id', auth()->user()->employee ? auth()->user()->employee->id : null);

                $query->where('status', 'examination');
            }
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return $data;
    }

    public function indexStatus(IndexQueue $request, $status)
    {

        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Queue::class)->processRequestAndGet(
            // pass the request with params
            $request,
            // set columns to query
            ['id', 'patient_id', 'employee_id', 'comment', 'queues_status', 'queue_number'],

            // set columns to searchIn
            ['id', 'queues_status', 'comment'],
            static function (Builder $query) use ($status) {

                if ($status == 'wait') {
                    $query->where('queues_status',  $status);
                }

                if ($status == 'examination') {
                    $query->where('queues_status',  $status);
                    $query->where('employee_id',  Auth::user()->employee->id ?? null);
                }
                if ($status == 'processing') {
                    $query->where('queues_status',  $status);
                    $query->where('employee_id',  Auth::user()->employee->id ?? null);
                }

                if ($status == 'examination_result') {
                    $query->whereIn('queues_status',  ['input_again', 'examination_result']);
                    $query->where('employee_id',  Auth::user()->employee->id ?? null);
                }
            }
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return $data;
    }



    /**
     * Display a listing of the resource.
     *
     * @param IndexPatientHistory $request
     * @return array|Factory|View
     */
    public function getPatientHistory(IndexPatientHistory $request, $patientId)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(PatientHistory::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'patient_id', 'test_at'],

            // set columns to searchIn
            ['id'],
            static function (Builder $query) use ($patientId) {
                $query->where('patient_id', $patientId);
            }
        );

        if ($request->ajax()) {

            return ['data' => $data];
        }

        return $data;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExamination $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StorePatientHistory $request)
    {
        DB::transaction(function ()  use ($request) {
            $priceTotal = 0;

            $labDetail = LabDetail::whereIn('id', collect($request->lab_detail)->pluck('lab_detail_id'))->get();
            $labDetail->map(function ($item) use ($priceTotal) {
                return $priceTotal += $item->price;
            });
            // Sanitize input
            $sanitized = $request->getSanitized();
            $sanitized['test_at'] = now()->toDateString();

            $queue =  Queue::find($request->queue_id);


            if ($request->status_add_edit == 'add') {
                $patientHistory = new PatientHistory();
                $patientHistory->patient_id = $request->patient_id;
                $patientHistory->patient_historyable_id = $request->queue_id;
                $patientHistory->patient_historyable_type = 'App\Models\Queue';
                $patientHistory->test_at = now()->toDateString();

                $patientHistory->save();

                $prescribeMedicines = new PrescribeMedicine();
                $prescribeMedicines->patient_history_id = $patientHistory->id;
                $prescribeMedicines->price_total = $priceTotal;
                $prescribeMedicines->employee_queue = $queue->employee->lao_first_name;
                $prescribeMedicines->date = now();
                $prescribeMedicines->save();

                foreach (collect($request->info)->all() as $key => $value) {
                    if ($value != null) {
                        $informationHistoryDetail = new InformationHistoryDetail();
                        $informationHistoryDetail->patient_history_id = $patientHistory->id;
                        $informationHistoryDetail->key = $key;
                        $informationHistoryDetail->value = $value;
                        $informationHistoryDetail->save();
                    }
                }

                foreach ($labDetail as $key => $value) {
                    $prescribeMedicinesDetails = new PrescribeMedicineDetail();
                    $prescribeMedicinesDetails->name = $value->name;
                    $prescribeMedicinesDetails->amount = 1;
                    $prescribeMedicinesDetails->lab_detail_id = $value->id;
                    $prescribeMedicinesDetails->status = 'lab_detail';
                    $prescribeMedicinesDetails->prescribe_medicine_id = $prescribeMedicines->id;
                    $prescribeMedicinesDetails->price = $value->price;
                    $prescribeMedicinesDetails->save();
                }

                $patientHistory->examinationServices()->detach();

                $patientHistory->examinationServices()->sync($request->lab_detail);

                event(new SendToLab('lab_department'));

            } else {

                $patientHistory =  PatientHistory::wherePatientHistoryableId($request->queue_id)->wherePatientHistoryableType('App\Models\Queue')->first();
                $prescribeMedicines =  PrescribeMedicine::wherePatientHistoryId($patientHistory->id)->first();

                $informationHistoryDetail = InformationHistoryDetail::wherePatientHistoryId($patientHistory->id)->delete();


                if ($informationHistoryDetail) {
                    foreach (collect($request->info)->all() as $key => $value) {
                        if ($value != null) {
                            $informationHistoryDetail = new InformationHistoryDetail();
                            $informationHistoryDetail->patient_history_id = $patientHistory->id;
                            $informationHistoryDetail->key = $key;
                            $informationHistoryDetail->value = $value;
                            $informationHistoryDetail->save();
                        }
                    }
                } else {
                    foreach (collect($request->info)->all() as $key => $value) {
                        if ($value != null) {
                            $informationHistoryDetail = new InformationHistoryDetail();
                            $informationHistoryDetail->patient_history_id = $patientHistory->id;
                            $informationHistoryDetail->key = $key;
                            $informationHistoryDetail->value = $value;
                            $informationHistoryDetail->save();
                        }
                    }
                }
                $patientHistory->examinationServices()->detach();
                $patientHistory->examinationServices()->sync($request->lab_detail);

                event(new SendToLab('lab_department'));
            }

            $queue->queues_status = 'examination';

            $queue->save();
        });


        event(new DoctorOnline(''));


        if ($request->ajax()) {
            return ['redirect' => url('admin/examinations'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/examinations');
    }


    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param Examination $examination
    //  * @throws AuthorizationException
    //  * @return Factory|View
    //  */
    public function edit(Queue $queue, IndexPatientHistory $requestPatientHistory)
    {
        $this->authorize('admin.examination.edit', $queue);
        return view('admin.examination.edit', [
            'examination' => $queue,
            'dataPatientHistory' => $this->getPatientHistory($requestPatientHistory, $queue->patient_id),
            'services' => Service::with('labDetailService')->orderBy('id')->get(),
        ]);
    }


    public function printExamination(Queue $queue)
    {
        return view('admin.examination.report-examination.index',[
            'services' => Service::with('labDetailService')->orderBy('id')->get(),
        ]);
    }
}
