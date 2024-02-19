<?php

namespace App\Http\Controllers\Admin;

use App\Events\Examination;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExamPackage\IndexExamPackage;
use App\Http\Requests\Admin\Medicine\IndexMedicine;
use App\Http\Requests\Admin\PrescribeMedicine\BulkDestroyPrescribeMedicine;
use App\Http\Requests\Admin\PrescribeMedicine\DestroyPrescribeMedicine;
use App\Http\Requests\Admin\PrescribeMedicine\IndexPrescribeMedicine;
use App\Http\Requests\Admin\PrescribeMedicine\StorePrescribeMedicine;
use App\Http\Requests\Admin\PrescribeMedicine\UpdatePrescribeMedicine;
use App\Http\Requests\Admin\Queue\IndexQueue;
use App\Http\Requests\Admin\ShoppingCart\ConfirmShoppingCart;
use App\Http\Requests\Admin\ShoppingCart\IndexShoppingCart;
use App\Http\Requests\Admin\ShoppingCart\StoreShoppingCart;
use App\Models\ExamPackage;
use App\Models\Medicine;
use App\Models\MedicinePricing;
use App\Models\PatientHistory;
use App\Models\PrescribeMedicine;
use App\Models\PrescribeMedicineDetail;
use App\Models\Queue;
use App\Models\ShoppingCart;
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

class PrescribeMedicinesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexPrescribeMedicine $request
     * @return array|Factory|View
     */
    public function index(IndexQueue $request, IndexExamPackage $requestExamination)
    {
        $data = AdminListing::create(Queue::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'patient_id', 'queue_number'],

            // set columns to searchIn
            ['id'],
            static function (Builder $query) {
                $query->with(['patient']);
                $query->where('queues_status', 'pharmacy');
            }
        );

        if ($request->ajax()) {

            return ['data' => $data];
        }
        // return $data;
        return view('admin.prescribe-medicine.index', ['data' => $data, 'dataExamPackage' => $this->indexExamPackage($requestExamination)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexExamPackage $request
     * @return array|Factory|View
     */
    public function indexExamPackage(IndexExamPackage $request)
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
                $query->where('status', 'pharmacy');
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


        return $data;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param PrescribeMedicine $prescribeMedicine
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Queue $queue, IndexMedicine $request, IndexShoppingCart $requestShoppingCart)
    {
        $this->authorize('admin.queue.edit', $queue);

        $queue->load('comments');

        return view('admin.prescribe-medicine.edit', [
            'queue' => $queue,
            'dataMedicine' => $this->getMedicine($request),
            'datashoppingCart' => $this->getShoppingCart($requestShoppingCart)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PrescribeMedicine $prescribeMedicine
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function editExamPackage(ExamPackage $examPackage, IndexMedicine $request, IndexShoppingCart $requestShoppingCart)
    {
        $this->authorize('admin.exam-package.edit', $examPackage);
        $doctorMedicines = $examPackage->patientHistory->doctorMedicines;

        return view('admin.prescribe-medicine.edit-exam-package', [
            'examPackage' => $examPackage,
            'dataMedicine' => $this->getMedicine($request),
            'doctorMedicines' => $doctorMedicines,
            'datashoppingCart' => $this->getShoppingCart($requestShoppingCart)
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @param IndexMedicine $request
     * @return array|Factory|View
     */
    public function getMedicine(IndexMedicine $request)
    {
        // $request['per_page'] = 100;
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(MedicinePricing::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'amount', 'base_price', 'best_before_date', 'manufacture_date', 'medicine_id', 'supplier_id', 'created_at','current_amount'],

            // set columns to searchIn
            ['id', 'medicine_id', 'supplier_id', 'medicines.cheminal_name'],
            static function (Builder $query) {
                $query->orderByDesc('created_at');

                $query->where('medicine_pricing.current_amount', '>', 0);

                $query->join('medicines', 'medicines.id', '=', 'medicine_pricing.medicine_id');
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
     * @param IndexShoppingCart $request
     * @return array|Factory|View
     */
    public function getShoppingCart(IndexShoppingCart $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ShoppingCart::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'medicine_id', 'medicine_pricing_id', 'price', 'amount'],

            // set columns to searchIn
            ['id']
        );

        if ($request->ajax()) {

            return ['data' => $data];
        }

        return $data;
    }

    public function addShoppingCart(StoreShoppingCart $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        $shoppingCart = ShoppingCart::whereMedicinePricingId($request->medicine_pricing_id)->first();
        $medicine = MedicinePricing::find($request->medicine_pricing_id);

        if ($shoppingCart) {
            if ($shoppingCart->amount >= $medicine->amount) {
                return response(['message' => 'Medicine ຫມົດແລ້ວ'], 403);
            }
        }

        if ($medicine->amount >= 0) {
            if ($shoppingCart) {
                $shoppingCart->amount += 1;
                $shoppingCart->save();
            } else {
                $shoppingCart = ShoppingCart::create($sanitized);
            }
        } else {
            return response(['message' => 'Medicine ຫມົດແລ້ວ'], 403);
        }
        if ($request->ajax()) {
            return ['message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/shopping-carts');
    }

    public function remove(StoreShoppingCart $request)
    {
        $shoppingCart = ShoppingCart::whereMedicineId($request->medicine_id)->first();

        $shoppingCart->delete();
    }

    public function addAmount(StoreShoppingCart $request)
    {
        $shoppingCart = ShoppingCart::whereMedicinePricingId($request->medicine_pricing_id)->first();
        $medicine = MedicinePricing::find($request->medicine_pricing_id);
        $shoppingCart->amount = $request->amount;

        if ($shoppingCart) {
            if ($shoppingCart->amount > $medicine->amount) {
                return response(['message' => 'Medicine ຫມົດແລ້ວ'], 403);
            }
        }

        $shoppingCart->save();
    }

    public function confirm(ConfirmShoppingCart $request)
    {
        DB::transaction(function () use ($request) {

            if ($request->status == 'queue') {
                $queue = Queue::find($request->id);

                $priceTotal = 0;

                if ($request->status_medicine == 'false') {
                    ShoppingCart::truncate();
                }

                $shoppingCart = ShoppingCart::all();

                foreach ($shoppingCart as $key => $value) {
                    $priceTotal += $value->price * $value->amount;
                }

                $prescribeMedicine = PrescribeMedicine::where('patient_history_id', $queue->patient_history_last->id)->first();
                $prescribeMedicine->price_total += $priceTotal;
                $prescribeMedicine->save();


                foreach ($shoppingCart as $key => $value) {
                    $prescribeMedicineDetails = new PrescribeMedicineDetail();
                    $prescribeMedicineDetails->prescribe_medicine_id = $prescribeMedicine->id;
                    $prescribeMedicineDetails->name = $value->medicine->cheminal_name;
                    $prescribeMedicineDetails->amount = $value->amount;
                    $prescribeMedicineDetails->medicine_id = $value->medicine_id;
                    $prescribeMedicineDetails->status = 'medicine';
                    $prescribeMedicineDetails->price = $value->price;
                    $prescribeMedicineDetails->save();

                    $medicine = Medicine::find($value->medicine_id);
                    $medicine->amount -= $value->amount;
                    $medicine->save();

                    $medicinePricing = MedicinePricing::find($value->medicine_pricing_id);
                    $medicinePricing->current_amount -= $value->amount;
                    $medicinePricing->save();
                }

                ShoppingCart::truncate();


                $queue->queues_status = 'payment';

                $queue->save();

                event(new Examination('payment'));
            }

            if ($request->status == 'package') {

                $examPackage = ExamPackage::find($request->id);

                $priceTotal = 0;

                if ($request->status_medicine == 'false') {
                    ShoppingCart::truncate();
                }

                $shoppingCart = ShoppingCart::all();

                foreach ($shoppingCart as $key => $value) {
                    $priceTotal += $value->price * $value->amount;
                }

                $prescribeMedicine = PrescribeMedicine::where('patient_history_id', $examPackage->patientHistory->id)->first();
                $prescribeMedicine->price_total += $priceTotal;
                $prescribeMedicine->save();


                foreach ($shoppingCart as $key => $value) {
                    $prescribeMedicineDetails = new PrescribeMedicineDetail();
                    $prescribeMedicineDetails->prescribe_medicine_id = $prescribeMedicine->id;
                    $prescribeMedicineDetails->name = $value->medicine->cheminal_name;
                    $prescribeMedicineDetails->amount = $value->amount;
                    $prescribeMedicineDetails->medicine_id = $value->medicine_id;
                    $prescribeMedicineDetails->status = 'medicine';
                    $prescribeMedicineDetails->price = $value->price;
                    $prescribeMedicineDetails->save();

                    $medicine = Medicine::find($value->medicine_id);
                    $medicine->amount -= $value->amount;
                    $medicine->save();

                    $medicinePricing = MedicinePricing::find($value->medicine_pricing_id);
                    $medicinePricing->current_amount -= $value->amount;
                    $medicinePricing->save();
                }

                $examPackage->status = 'payment';

                $examPackage->save();

                ShoppingCart::truncate();
            }
        });


        if ($request->ajax()) {
            return ['redirect' => url('admin/prescribe-medicines'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }
    }
}
