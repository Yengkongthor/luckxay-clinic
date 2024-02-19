<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MedicinePricing\BulkDestroyMedicinePricing;
use App\Http\Requests\Admin\MedicinePricing\DestroyMedicinePricing;
use App\Http\Requests\Admin\MedicinePricing\IndexMedicinePricing;
use App\Http\Requests\Admin\MedicinePricing\StoreMedicinePricing;
use App\Http\Requests\Admin\MedicinePricing\UpdateMedicinePricing;
use App\Models\Medicine;
use App\Models\MedicinePricing;
use App\Models\Supplier;
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

class MedicinePricingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexMedicinePricing $request
     * @return array|Factory|View
     */
    public function index(IndexMedicinePricing $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(MedicinePricing::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['amount', 'base_price', 'best_before_date', 'id', 'manufacture_date', 'medicine_id'],

            // set columns to searchIn
            ['id', 'base_price', 'best_before_date', 'id', 'manufacture_date','medicines.cheminal_name','medicines.dose'],
            static function (Builder $q) {
                $q->join('medicines', 'medicine_pricing.medicine_id',"=", 'medicines.id');
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

        return view('admin.medicine-pricing.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.medicine-pricing.create');

        return view('admin.medicine-pricing.create', [
            'medicines' => Medicine::all(),
            'suppliers' => Supplier::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMedicinePricing $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreMedicinePricing $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        $sanitized['medicine_id'] = $request->getMedicineId();
        $sanitized['supplier_id'] = $request->getSupplierId();
        $sanitized['current_amount'] = $request->amount;

        // Store the MedicinePricing
        $medicinePricing = MedicinePricing::create($sanitized);

        $medicine = Medicine::find($medicinePricing->medicine_id);
        $medicine->amount += $medicinePricing->amount;
        $medicine->save();

        if ($request->ajax()) {
            return ['redirect' => url('admin/medicine-pricings'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/medicine-pricings');
    }

    /**
     * Display the specified resource.
     *
     * @param MedicinePricing $medicinePricing
     * @throws AuthorizationException
     * @return void
     */
    public function show(MedicinePricing $medicinePricing)
    {
        $this->authorize('admin.medicine-pricing.show', $medicinePricing);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MedicinePricing $medicinePricing
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(MedicinePricing $medicinePricing)
    {
        $this->authorize('admin.medicine-pricing.edit', $medicinePricing);
        $medicinePricing->load('supplier');


        return view('admin.medicine-pricing.edit', [
            'medicinePricing' => $medicinePricing,
            'medicines' => Medicine::all(),
            'suppliers' => Supplier::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMedicinePricing $request
     * @param MedicinePricing $medicinePricing
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateMedicinePricing $request, MedicinePricing $medicinePricing)
    {
        $sanitized = $request->getSanitized();

        $medicine = Medicine::find($medicinePricing->medicine_id);

        $medicine->amount -= $medicinePricing->amount;

        $medicine->save();

        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Role
        $medicinePricing->update($sanitized);


        $medicine = Medicine::find($medicinePricing->medicine_id);
        $medicine->amount += $medicinePricing->amount;
        $medicine->save();

        if ($request->ajax()) {
            return ['redirect' => url('admin/medicine-pricings'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/medicine-pricings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyMedicinePricing $request
     * @param MedicinePricing $medicinePricing
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyMedicinePricing $request, MedicinePricing $medicinePricing)
    {

        $medicine = Medicine::find($medicinePricing->medicine_id);

        $medicine->amount -= $medicinePricing->amount;

        $medicine->save();


        $medicinePricing->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyMedicinePricing $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyMedicinePricing $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    MedicinePricing::whereIn('id', $bulkChunk)->delete();
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
