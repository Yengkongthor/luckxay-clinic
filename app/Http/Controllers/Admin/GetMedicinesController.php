<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExamPackage\IndexExamPackage;
use App\Http\Requests\Admin\GetMedicine\BulkDestroyGetMedicine;
use App\Http\Requests\Admin\GetMedicine\DestroyGetMedicine;
use App\Http\Requests\Admin\GetMedicine\IndexGetMedicine;
use App\Http\Requests\Admin\GetMedicine\StoreGetMedicine;
use App\Http\Requests\Admin\GetMedicine\UpdateGetMedicine;
use App\Http\Requests\Admin\Queue\IndexQueue;
use App\Models\DoctorMedicine;
use App\Models\ExamPackage;
use App\Models\GetMedicine;
use App\Models\Queue;
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

class GetMedicinesController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @param IndexPayment $request
     * @return array|Factory|View
     */
    public function index(IndexQueue $request, IndexExamPackage $requestExamPackage)
    {

        return view('admin.get-medicine.index', [
            'data' => $this->indexStatus($request, 'pay_already'),
            'dataFinished' => $this->indexStatus($request, 'finished'),
            'dataExamPackage' => $this->indexExamPackageStatus($requestExamPackage, ''),
            'dataExamPackageFinished' => $this->indexExamPackageStatus($requestExamPackage, 'finished'),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexExamPackage $request
     * @return array|Factory|View
     */
    public function indexExamPackageStatus(IndexExamPackage $request, $status)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ExamPackage::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['employee_id', 'id', 'package_id', 'status'],

            // set columns to searchIn
            ['id', 'status'],
            static function (Builder $query) use ($status) {
                if ($status == 'finished') {
                    $query->where('status', 'finished');
                } else {
                    $query->where('status', 'pay_already');
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
     * @param IndexPayment $request
     * @return array|Factory|View
     */
    public function indexStatus(IndexQueue $request, $status)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Queue::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'patient_id', 'queues_status', 'queue_number'],

            // set columns to searchIn
            ['id'],
            static function (Builder $query) use ($status) {
                if ($status == 'pay_already') {
                    $query->where('queues_status', 'pay_already');
                }
                if ($status == 'finished') {
                    $query->where('queues_status', 'finished');
                }
            }
        );

        if ($request->ajax()) {

            return ['data' => $data];
        }

        return $data;
    }

    public function update(Request $request)
    {

        if ($request->status == 'package') {
            $examPackage = ExamPackage::find($request->exam_package_id);

            $examPackage->status = 'finished';

            $examPackage->save();

            if ($request->ajax()) {
                return ['redirect' => url('admin/get-medicines'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
            }
        } else {
            $queue = Queue::find($request->queue_id);

            $queue->queues_status = 'finished';

            $queue->save();

            if ($request->ajax()) {
                return ['redirect' => url('admin/get-medicines'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
            }
        }
    }

    public function printMedicine(Request $request)
    {

        $queue = Queue::find($request->queue_id);
        $doctorMedicines =  DoctorMedicine::find($request->id);
        $patient_name =  $queue->patient_history_last->patient->user->name;


        return view('admin.get-medicine.components.bill.bill-medicine-10-8', ['doctorMedicines' => $doctorMedicines, 'patient_name' => $patient_name]);
    }
    public function printMedicine75(Request $request)
    {
        Log::alert($request);
        $queue = Queue::find($request->queue_id);
        // $doctorMedicines =  $queue->patient_history_last->doctorMedicines;
        $doctorMedicines =  DoctorMedicine::find($request->id);
        $patient_name =  $queue->patient_history_last->patient->user->name;


        return view('admin.get-medicine.components.bill.bill-medicine-7-5', ['doctorMedicines' => $doctorMedicines, 'patient_name' => $patient_name]);
    }
    public function printMedicine1015(Request $request)
    {

        $queue = Queue::find($request->queue_id);
        $doctorMedicines =  DoctorMedicine::find($request->id);
        $patient_name =  $queue->patient_history_last->patient->user->name;



        return view('admin.get-medicine.components.bill.bill-medicine-10-15', ['doctorMedicines' => $doctorMedicines, 'patient_name' => $patient_name]);
    }
    public function printSaline108(Request $request)
    {

        $queue = Queue::find($request->queue_id);

        $patient_name =  $queue->patient_history_last->patient->user->name;

        $age =  $queue->patient_history_last->patient->age;

        return view('admin.get-medicine.components.bill.bill-saline-10-8', ['patient_name' => $patient_name, 'age' => $age]);
    }
    public function printSaline75(Request $request)
    {

        $queue = Queue::find($request->queue_id);
        // $doctorMedicines =  $queue->patient_history_last->doctorMedicines;

        $patient_name =  $queue->patient_history_last->patient->user->name;
        $age =  $queue->patient_history_last->patient->age;

        return view('admin.get-medicine.components.bill.bill-saline-7-5', ['patient_name' => $patient_name, 'age' => $age]);
    }
    public function printSaline1015(Request $request)
    {

        $queue = Queue::find($request->queue_id);
        $patient_name =  $queue->patient_history_last->patient->user->name;

        $age =  $queue->patient_history_last->patient->age;

        return view('admin.get-medicine.components.bill.bill-saline-10-15', ['patient_name' => $patient_name, 'age' => $age]);
    }

    public function printMedicinePackage(Request $request)
    {
        $examPackage = ExamPackage::find($request->exam_package_id);
        $doctorMedicines =  $examPackage->patientHistory->doctorMedicines;

        $patient_name =  $examPackage->patientHistory->patient->user->name;


        return view('admin.get-medicine.components.bill.bill-medicine-package', ['doctorMedicines' => $doctorMedicines, 'patient_name' => $patient_name]);
    }
}
