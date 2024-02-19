<?php

namespace App\Http\Controllers\Admin;

use App\Events\Examination;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Package\IndexPackage;
use App\Http\Requests\Admin\Payment\BulkDestroyPayment;
use App\Http\Requests\Admin\Payment\DestroyPayment;
use App\Http\Requests\Admin\Payment\IndexPayment;
use App\Http\Requests\Admin\Payment\StorePayment;
use App\Http\Requests\Admin\Payment\UpdatePayment;
use App\Http\Requests\Admin\Queue\IndexQueue;
use App\Http\Requests\PayRequest;
use App\Models\ExamPackage;
use App\Models\Exchange;
use App\Models\PatientHistory;
use App\Models\Payment;
use App\Models\PrescribeMedicine;
use App\Models\PrescribeMedicineCharge;
use App\Models\PrescribeMedicineDetail;
use App\Models\Queue;
use App\Models\Wage;
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

class PaymentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexPayment $request
     * @return array|Factory|View
     */
    public function index(IndexQueue $request, IndexPackage $requestPackage)
    {
        return view('admin.payment.index', [
            'data' => $this->indexStatus($request, 'payment'),
            'payAlready' => $this->indexStatus($request, ''),
            'dataExamPackage' => $this->getPayPackage($requestPackage),

        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexPayment $request
     * @return array|Factory|View
     */
    public function getPayPackage(IndexPackage $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ExamPackage::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'package_id', 'employee_id', 'status'],

            // set columns to searchIn
            ['id'],
            static function (Builder $query) {
                $query->where('status', 'payment');
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
            ['id', 'patient_id', 'queue_number'],

            // set columns to searchIn
            ['id'],
            static function (Builder $query) use ($status) {
                if ($status == 'payment') {
                    $query->where('queues_status', 'payment');
                } else {
                    $query->whereIn('queues_status', ['pay_already', 'get_medicine']);
                }
            }
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return $data;
    }

    public function edit(Queue $queue)
    {

        $this->authorize('admin.queue.edit', $queue);

        $prescribeMedicine = PrescribeMedicine::wherePatientHistoryId($queue->patient_history_last->id)->first();


        $charge = $prescribeMedicine->prescribeMedicineCharge ?  $prescribeMedicine->prescribeMedicineCharge->charge : 0;
        $vat =  $prescribeMedicine->prescribeMedicineCharge ?  $prescribeMedicine->prescribeMedicineCharge->vat : 0;
        $exam_fee_discount = $prescribeMedicine->prescribeMedicineCharge ?  $prescribeMedicine->prescribeMedicineCharge->exam_fee_discount : 0;
        $discounted_services = $prescribeMedicine->prescribeMedicineCharge ? $prescribeMedicine->prescribeMedicineCharge->discounted_services : 0;
        $doctor_fee = $prescribeMedicine->prescribeMedicineCharge ? $prescribeMedicine->prescribeMedicineCharge->doctor_fee : 0;
        $doctor_fee_discount = $prescribeMedicine->prescribeMedicineCharge ? $prescribeMedicine->prescribeMedicineCharge->doctor_fee_discount : 0;
        $medicine_discount = $prescribeMedicine->prescribeMedicineCharge ? $prescribeMedicine->prescribeMedicineCharge->medicine_discount : 0;

        $exchange = Exchange::orderByDesc('created_at')->first();


        $usd = $prescribeMedicine->price_total /  $exchange->usd;
        $thb = $prescribeMedicine->price_total /  $exchange->thb;


        return view('admin.payment.edit', [
            'queue' => $queue,
            'prescribeMedicine' => $prescribeMedicine,
            'totalMedicine' => $prescribeMedicine->total_medicine,
            'totalLabDetail' => $prescribeMedicine->total_lab_detail,
            'status' => 'examination',
            'wages' => Wage::all(),
            'charge' => $charge,
            'vat' => $vat,
            'exam_fee_discount' => $exam_fee_discount,
            'discounted_services' => $discounted_services,
            'doctor_fee' => $doctor_fee,
            'doctor_fee_discount' => $doctor_fee_discount,
            'medicine_discount' => $medicine_discount,
            'money' => number_format($prescribeMedicine->price_total),
            'thb' => number_format($thb ?? 0, 2),
            'usd' => number_format($usd ?? 0, 2),
        ]);
    }
    public function editPackage(ExamPackage $examPackage)
    {

        $this->authorize('admin.exam-package.edit', $examPackage);

        $prescribeMedicine = PrescribeMedicine::wherePatientHistoryId($examPackage->patientHistory->id)->first();

        $charge = $prescribeMedicine->prescribeMedicineCharge ?  $prescribeMedicine->prescribeMedicineCharge->charge : 0;
        $vat =  $prescribeMedicine->prescribeMedicineCharge ?  $prescribeMedicine->prescribeMedicineCharge->vat : 0;
        $exam_fee_discount = $prescribeMedicine->prescribeMedicineCharge ?  $prescribeMedicine->prescribeMedicineCharge->exam_fee_discount : 0;
        $discounted_services = $prescribeMedicine->prescribeMedicineCharge ? $prescribeMedicine->prescribeMedicineCharge->discounted_services : 0;
        $doctor_fee = $prescribeMedicine->prescribeMedicineCharge ? $prescribeMedicine->prescribeMedicineCharge->doctor_fee : 0;
        $doctor_fee_discount = $prescribeMedicine->prescribeMedicineCharge ? $prescribeMedicine->prescribeMedicineCharge->doctor_fee_discount : 0;
        $medicine_discount = $prescribeMedicine->prescribeMedicineCharge ? $prescribeMedicine->prescribeMedicineCharge->medicine_discount : 0;



        $exchange = Exchange::orderByDesc('created_at')->first();

        $usd = $prescribeMedicine->price_total / $exchange->usd;
        $thb = $prescribeMedicine->price_total / $exchange->thb;

        // return $examPackage;
        return view('admin.payment.edit', [
            'queue' => $examPackage,
            'prescribeMedicine' => $prescribeMedicine,
            'totalMedicine' => $prescribeMedicine->total_medicine,
            'totalLabDetail' => $prescribeMedicine->total_lab_detail,
            'status' => 'package',
            'wages' => Wage::all(),
            'charge' => $charge,
            'vat' => $vat,
            'exam_fee_discount' => $exam_fee_discount,
            'discounted_services' => $discounted_services,
            'doctor_fee' => $doctor_fee,
            'doctor_fee_discount' => $doctor_fee_discount,
            'medicine_discount' => $medicine_discount,
            'money' => number_format($prescribeMedicine->price_total),
            'thb' => number_format($thb ?? 0, 2),
            'usd' => number_format($usd ?? 0, 2),
        ]);
    }

    public function pay(Request $request)
    {
        if ($request->status == 'package') {
            $totalMedicine = 0;
            $totalLabDetail = 0;
            $examPackage = ExamPackage::find($request->id);

            $examPackage->status = 'pay_already';

            $prescribeMedicine = PrescribeMedicine::wherePatientHistoryId($examPackage->patientHistory->id)->first();

            $paientHistory = PatientHistory::find($examPackage->patientHistory->id);

            $prescribeMedicineDetailLabDetail = PrescribeMedicineDetail::wherePrescribeMedicineId($prescribeMedicine->id)->where('status', 'package')->get();
            $prescribeMedicineDetailMedicine = PrescribeMedicineDetail::wherePrescribeMedicineId($prescribeMedicine->id)->where('status', 'medicine')->get();

            foreach ($prescribeMedicineDetailLabDetail as $key => $value) {
                $totalLabDetail += $value->price;
            }
            foreach ($prescribeMedicineDetailMedicine as $key => $value) {
                $totalMedicine += $value->price  * $value->amount;
            }

            $prescribeMedicineCharge = new PrescribeMedicineCharge();
            $prescribeMedicineCharge->prescribe_medicine_id = $prescribeMedicine->id;
            $prescribeMedicineCharge->charge = $request->pay['charge'];
            $prescribeMedicineCharge->vat = $request->pay['vat'];
            $prescribeMedicineCharge->exam_fee_discount = $request->pay['exam_fee_discount'];
            $prescribeMedicineCharge->discounted_services = $request->pay['discounted_services'];
            $prescribeMedicineCharge->discount_total_money = $request->pay['discount_total_money'];
            $prescribeMedicineCharge->doctor_fee = $paientHistory->doctor_fee;
            $prescribeMedicineCharge->doctor_fee_discount = $paientHistory->doctor_fee_discount;
            $prescribeMedicineCharge->medicine_discount = $request->pay['medicine_discount'];

            $prescribeMedicineCharge->save();

            $totalMoney = 0;

            $totalMoney = ($prescribeMedicineCharge->doctor_fee - (($prescribeMedicineCharge->doctor_fee_discount / 100) *  $prescribeMedicineCharge->doctor_fee)) + ($totalLabDetail - (($prescribeMedicineCharge->exam_fee_discount / 100) * $totalLabDetail)) + ($prescribeMedicineCharge->charge - (($prescribeMedicineCharge->discounted_services / 100) * $prescribeMedicineCharge->charge))  + ($totalMedicine - (($prescribeMedicineCharge->medicine_discount / 100) * $totalMedicine));

            $vat = ($totalMoney * $prescribeMedicineCharge->vat) / 100;

            $prescribeMedicine->money =  $totalMoney;
            $prescribeMedicine->total_lab_detail =  $totalLabDetail;
            $prescribeMedicine->total_medicine =  $totalMedicine;
            $prescribeMedicine->price_total =  $totalMoney + $vat;

            $prescribeMedicine->save();

            $examPackage->save();


            return ['redirect' => url('admin/payments/' . $examPackage->id . '/edit-package'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        } else {
            $totalMedicine = 0;
            $totalLabDetail = 0;
            $queue = Queue::find($request->id);

            $queue->queues_status = 'pay_already';

            $prescribeMedicine = PrescribeMedicine::wherePatientHistoryId($queue->patient_history_last->id)->first();

            $paientHistory = PatientHistory::find($queue->patient_history_last->id);

            $prescribeMedicineDetailLabDetail = PrescribeMedicineDetail::wherePrescribeMedicineId($prescribeMedicine->id)->where('status', 'lab_detail')->get();
            $prescribeMedicineDetailMedicine = PrescribeMedicineDetail::wherePrescribeMedicineId($prescribeMedicine->id)->where('status', 'medicine')->get();

            foreach ($prescribeMedicineDetailLabDetail as $key => $value) {
                $totalLabDetail += $value->price;
            }
            foreach ($prescribeMedicineDetailMedicine as $key => $value) {
                $totalMedicine += $value->price  * $value->amount;
            }

            $prescribeMedicineCharge = new PrescribeMedicineCharge();
            $prescribeMedicineCharge->prescribe_medicine_id = $prescribeMedicine->id;
            $prescribeMedicineCharge->charge = $request->pay['charge'];
            $prescribeMedicineCharge->vat = $request->pay['vat'];
            $prescribeMedicineCharge->exam_fee_discount = $request->pay['exam_fee_discount'];
            $prescribeMedicineCharge->discounted_services = $request->pay['discounted_services'];
            $prescribeMedicineCharge->doctor_fee = $paientHistory->doctor_fee;
            $prescribeMedicineCharge->discount_total_money = $request->pay['discount_total_money'];
            $prescribeMedicineCharge->doctor_fee_discount = $paientHistory->doctor_fee_discount;
            $prescribeMedicineCharge->medicine_discount = $request->pay['medicine_discount'];

            $prescribeMedicineCharge->save();

            $totalMoney = 0;

            $totalMoney = ($prescribeMedicineCharge->doctor_fee - (($prescribeMedicineCharge->doctor_fee_discount / 100) *  $prescribeMedicineCharge->doctor_fee)) + ($totalLabDetail - (($prescribeMedicineCharge->exam_fee_discount / 100) * $totalLabDetail)) + ($prescribeMedicineCharge->charge - (($prescribeMedicineCharge->discounted_services / 100) * $prescribeMedicineCharge->charge))  + ($totalMedicine - (($prescribeMedicineCharge->medicine_discount / 100) * $totalMedicine));

            $vat = ($totalMoney * $prescribeMedicineCharge->vat) / 100;
            $prescribeMedicine->money =  $totalMoney;
            $prescribeMedicine->total_lab_detail =  $totalLabDetail;
            $prescribeMedicine->total_medicine =  $totalMedicine;
            $prescribeMedicine->price_total =  $totalMoney + $vat;

            $prescribeMedicine->save();



            $queue->save();

            event(new Examination('pay_already'));

            return ['redirect' => url('admin/payments/' . $queue->id . '/edit'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }
    }

    public function print(Request $request)
    {
        if ($request->status == 'package') {

            $examPackage = ExamPackage::find($request->queue_id);

            $prescribeMedicine = PrescribeMedicine::wherePatientHistoryId($examPackage->patientHistory->id)->first();

            $charge = $prescribeMedicine->prescribeMedicineCharge->charge;
            $vat = $prescribeMedicine->prescribeMedicineCharge->vat;
            $exam_fee_discount = $prescribeMedicine->prescribeMedicineCharge->exam_fee_discount;
            $discounted_services = $prescribeMedicine->prescribeMedicineCharge->discounted_services;
            $doctor_fee =  $prescribeMedicine->prescribeMedicineCharge->doctor_fee;
            $doctor_fee_discount =  $prescribeMedicine->prescribeMedicineCharge->doctor_fee_discount;
            $medicine_discount =  $prescribeMedicine->prescribeMedicineCharge->medicine_discount;
            $discount_total_money =  $prescribeMedicine->prescribeMedicineCharge->discount_total_money;


            $exchange = Exchange::orderByDesc('created_at')->first();

            $usd = $prescribeMedicine->price_total / $exchange->usd;
            $thb = $prescribeMedicine->price_total / $exchange->thb;


            return view('admin.reports.bills.payment-medicine-package', [
                'queue' => $examPackage,
                'prescribeMedicine' => $prescribeMedicine,
                'totalMedicine' => $prescribeMedicine->total_medicine,
                'totalLabDetail' => $prescribeMedicine->total_lab_detail,
                'status' => 'examination',
                'wages' => Wage::all(),
                'charge' => $charge,
                'vat' => $vat,
                'exam_fee_discount' => $exam_fee_discount,
                'discounted_services' => $discounted_services,
                'doctor_fee' => $doctor_fee,
                'doctor_fee_discount' => $doctor_fee_discount,
                'discount_total_money' => $discount_total_money,
                'medicine_discount' => $medicine_discount,
                'money' => $prescribeMedicine->price_total,
                'thb' => number_format($thb ?? 0, 2),
                'usd' => number_format($usd ?? 0, 2),
            ]);
        } else {
            $totalMedicine = 0;
            $totalLabDetail = 0;
            $queue = Queue::find($request->queue_id);

            $prescribeMedicine = PrescribeMedicine::wherePatientHistoryId($queue->patient_history_last->id)->first();

            $charge = $prescribeMedicine->prescribeMedicineCharge->charge;
            $vat = $prescribeMedicine->prescribeMedicineCharge->vat;
            $exam_fee_discount = $prescribeMedicine->prescribeMedicineCharge->exam_fee_discount;
            $discounted_services = $prescribeMedicine->prescribeMedicineCharge->discounted_services;
            $doctor_fee =  $prescribeMedicine->prescribeMedicineCharge->doctor_fee;
            $doctor_fee_discount =  $prescribeMedicine->prescribeMedicineCharge->doctor_fee_discount;
            $medicine_discount =  $prescribeMedicine->prescribeMedicineCharge->medicine_discount;
            $discount_total_money =  $prescribeMedicine->prescribeMedicineCharge->discount_total_money;


            $exchange = Exchange::orderByDesc('created_at')->first();

            $usd = $prescribeMedicine->price_total / $exchange->usd;
            $thb = $prescribeMedicine->price_total / $exchange->thb;

            return view('admin.reports.bills.payment-medicine', [
                'queue' => $queue,
                'prescribeMedicine' => $prescribeMedicine,
                'totalMedicine' => $prescribeMedicine->total_medicine,
                'totalLabDetail' => $prescribeMedicine->total_lab_detail,
                'status' => 'examination',
                'wages' => Wage::all(),
                'charge' => $charge,
                'vat' => $vat,
                'exam_fee_discount' => $exam_fee_discount,
                'discounted_services' => $discounted_services,
                'doctor_fee' => $doctor_fee,
                'discount_total_money' => $discount_total_money,
                'doctor_fee_discount' => $doctor_fee_discount,
                'medicine_discount' => $medicine_discount,
                'money' => $prescribeMedicine->price_total,
                'thb' => $thb ?? 0,
                'usd' => number_format($usd ?? 0, 2),
            ]);
        }
    }

    public function destroy(Request $request, Queue $queue)
    {
        $paientHistory = PatientHistory::where('patient_historyable_id', $queue->id)->where('patient_historyable_type', Queue::class)->first();
        $prescribeMedicine = PrescribeMedicine::where('patient_history_id',$paientHistory->id);
        $prescribeMedicine->first()->prescribeMedicineCharge->delete();
        $prescribeMedicine->first()->prescribeMedicineCharge->delete();

        $prescribeMedicine->delete();
        $queue->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
