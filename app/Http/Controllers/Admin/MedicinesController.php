<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Medicine\BulkDestroyMedicine;
use App\Http\Requests\Admin\Medicine\DestroyMedicine;
use App\Http\Requests\Admin\Medicine\IndexMedicine;
use App\Http\Requests\Admin\Medicine\StoreMedicine;
use App\Http\Requests\Admin\Medicine\UpdateMedicine;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Medicine;
use App\Models\MedicineHistory;
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
use Request;

class MedicinesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexMedicine $request
     * @return array|Factory|View
     */
    public function index(IndexMedicine $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Medicine::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'cheminal_name', 'dose', 'price', 'brand_id', 'category_id', 'amount', 'min_amount'],

            // set columns to searchIn
            ['id', 'cheminal_name', 'dose',]
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.medicine.index', ['data' => $data]);
    }

    public function getMedicineHistory(IndexMedicine $request, $medicineId)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(MedicineHistory::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'price', 'status_approved'],

            ['id', 'price', 'status_approved'],

            static function (Builder $query) use ($medicineId) {
                $query->where('medicine_id', $medicineId)->where('status_approved', false);
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
        $this->authorize('admin.medicine.create');

        return view('admin.medicine.create', [
            'brands' => Brand::all(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMedicine $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreMedicine $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized['brand_id'] = $request->getBrandId();
        $sanitized['category_id'] = $request->getCategoryId();

        // Store the Medicine
        $medicine = Medicine::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/medicines'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/medicines');
    }

    /**
     * Display the specified resource.
     *
     * @param Medicine $medicine
     * @throws AuthorizationException
     * @return void
     */
    public function show(Medicine $medicine)
    {
        $this->authorize('admin.medicine.show', $medicine);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Medicine $medicine
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Medicine $medicine, IndexMedicine $request)
    {
        $this->authorize('admin.medicine.edit', $medicine);

        $medicineHistory = MedicineHistory::whereMedicineId($medicine->id)->whereStatusApproved(false)->get();
        // return $medicineHistory;
        return view('admin.medicine.edit', [
            'medicine' => $medicine,
            'data' => $this->getMedicineHistory($request, $medicine->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMedicine $request
     * @param Medicine $medicine
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateMedicine $request, Medicine $medicine)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        $sanitized['brand_id'] = $request->getBrandId();
        $sanitized['category_id'] = $request->getCategoryId();

        if ($medicine->price != $request->price) {
            $medicineHistory = MedicineHistory::whereMedicineId($medicine->id)->whereStatusApproved(false)->first();
            if ($medicineHistory) {
                return response(['message' => 'Approved ກ່ອນ.'], 403);
            } else {
                $sanitized['medicine_id'] = $medicine->id;
                $medicineHistory = MedicineHistory::create($sanitized);
            }
            $sanitized['price'] = $medicine->price;
        }

        // Update changed values Medicine
        $medicine->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/medicines'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/medicines');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyMedicine $request
     * @param Medicine $medicine
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyMedicine $request, Medicine $medicine)
    {
        $medicine->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyMedicine $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyMedicine $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Medicine::whereIn('id', $bulkChunk)->delete();
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    public function indexMedicineHistory(IndexMedicine $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(MedicineHistory::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'price', 'medicine_id'],

            // set columns to searchIn
            ['id', 'price'],
            static function (Builder $query) {
                $query->where('status_approved', 0);

                $query->with('medicine');
            }
        );

        if ($request->ajax()) {

            return ['data' => $data];
        }

        return $data;
    }

    public function preview(IndexMedicine $request)
    {
        return view('admin.medicine.report.update-price', ['medicineHistory' => $this->indexMedicineHistory($request)]);
    }


    public function updatePrice(Request $request)
    {
        $medicineHistory = MedicineHistory::where('status_approved', 0)->with('medicine')->get();

        foreach ($medicineHistory as $key => $value) {
            $medicine = Medicine::find($value->medicine_id);
            if ($medicine) {
                $medicine->price = $value->price;
                $medicine->save();
            }

            $updateMedicineHistory = MedicineHistory::find($value->id);
            $updateMedicineHistory->status_approved = 1;

            $updateMedicineHistory->save();
        }

        return [
            'redirect' => url('admin/medicines'),
            'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
        ];
    }

    public function printStock($typePrint)
    {

        if ($typePrint == 'all') {
            $medicine = Medicine::all();
        }

        if ($typePrint == 'warning') {
            $medicine = Medicine::whereColumn('amount', '<=', 'min_amount')->where('amount', '!=', 0)->get();
        }

        if ($typePrint == 'danger') {
            $medicine = Medicine::where('amount', 0)->get();
        }


        return view('admin.medicine.print.sock', ['medicine' => $medicine]);
    }
}
