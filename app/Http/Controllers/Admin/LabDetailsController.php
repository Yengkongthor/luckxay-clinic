<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LabDetail\BulkDestroyLabDetail;
use App\Http\Requests\Admin\LabDetail\DestroyLabDetail;
use App\Http\Requests\Admin\LabDetail\IndexLabDetail;
use App\Http\Requests\Admin\LabDetail\StoreLabDetail;
use App\Http\Requests\Admin\LabDetail\UpdateLabDetail;
use App\Models\ExaminationService;
use App\Models\Lab;
use App\Models\LabDetail;
use App\Models\LabDetailService;
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

class LabDetailsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexLabDetail $request
     * @return array|Factory|View
     */
    public function index(IndexLabDetail $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(LabDetail::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'lab_id', 'name', 'unit', 'reference', 'cost', 'price'],

            // set columns to searchIn
            ['id', 'name', 'unit', 'reference'],
            static function (Builder $query) use($request) {
                $query->with('lab');

                $query->where('lab_id', $request->labId);

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

        return view('admin.lab-detail.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.lab-detail.create');

        return view('admin.lab-detail.create', [
            'labs' => Lab::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLabDetail $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreLabDetail $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the LabDetail
        $labDetail = LabDetail::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/labs/' . $labDetail->lab_id . '/edit'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/lab-details');
    }

    /**
     * Display the specified resource.
     *
     * @param LabDetail $labDetail
     * @throws AuthorizationException
     * @return void
     */
    public function show(LabDetail $labDetail)
    {
        $this->authorize('admin.lab-detail.show', $labDetail);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param LabDetail $labDetail
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(LabDetail $labDetail)
    {
        $this->authorize('admin.lab-detail.edit', $labDetail);


        return view('admin.lab-detail.edit', [
            'labDetail' => $labDetail,
            'labs' => Lab::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLabDetail $request
     * @param LabDetail $labDetail
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateLabDetail $request, LabDetail $labDetail)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values LabDetail
        $labDetail->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/lab-details'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/lab-details');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyLabDetail $request
     * @param LabDetail $labDetail
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyLabDetail $request, LabDetail $labDetail)
    {

        $labDetailService = LabDetailService::whereLabId($labDetail->id)->first();

        if (isset($labDetailService)) {
            return response(['message' => 'LabDetail ນີ້ຖືກນຳໃຊ້ໃນ LabDetailService ແລ້ວບໍ່ສາມາດລົບໄດ້.'], 403);
        }

        $examinationService = ExaminationService::whereLabDetailId($labDetail->id)->first();

        if (isset($examinationService)) {
            return response(['message' => 'LabDetail ນີ້ຖືກນຳໃຊ້ໃນ ExaminationService ແລ້ວບໍ່ສາມາດລົບໄດ້.'], 403);
        }

        $labDetail->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyLabDetail $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyLabDetail $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    LabDetail::whereIn('id', $bulkChunk)->delete();


                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
