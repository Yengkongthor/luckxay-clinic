<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MedicineHistory\BulkDestroyMedicineHistory;
use App\Http\Requests\Admin\MedicineHistory\DestroyMedicineHistory;
use App\Http\Requests\Admin\MedicineHistory\IndexMedicineHistory;
use App\Http\Requests\Admin\MedicineHistory\StoreMedicineHistory;
use App\Http\Requests\Admin\MedicineHistory\UpdateMedicineHistory;
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

class MedicineHistoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexMedicineHistory $request
     * @return array|Factory|View
     */
    public function index(IndexMedicineHistory $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(MedicineHistory::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'medicine_id', 'cost', 'price', 'status_approved'],

            // set columns to searchIn
            ['id'],
            static function (Builder $query) use ($request) {
                $query->where('status_approved', false)->where('medicine_id', $request->medicine_id);
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

        return view('admin.medicine-history.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.medicine-history.create');

        return view('admin.medicine-history.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMedicineHistory $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreMedicineHistory $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the MedicineHistory
        $medicineHistory = MedicineHistory::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/medicine-histories'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/medicine-histories');
    }

    /**
     * Display the specified resource.
     *
     * @param MedicineHistory $medicineHistory
     * @throws AuthorizationException
     * @return void
     */
    public function show(MedicineHistory $medicineHistory)
    {
        $this->authorize('admin.medicine-history.show', $medicineHistory);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MedicineHistory $medicineHistory
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(MedicineHistory $medicineHistory)
    {
        $this->authorize('admin.medicine-history.edit', $medicineHistory);


        return view('admin.medicine-history.edit', [
            'medicineHistory' => $medicineHistory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMedicineHistory $request
     * @param MedicineHistory $medicineHistory
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateMedicineHistory $request, MedicineHistory $medicineHistory)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values MedicineHistory
        $medicineHistory->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/medicine-histories'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/medicine-histories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyMedicineHistory $request
     * @param MedicineHistory $medicineHistory
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyMedicineHistory $request, MedicineHistory $medicineHistory)
    {
        $medicineHistory->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyMedicineHistory $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyMedicineHistory $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    MedicineHistory::whereIn('id', $bulkChunk)->delete();

                    
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
