<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\BulkDestroyService;
use App\Http\Requests\Admin\Service\DestroyService;
use App\Http\Requests\Admin\Service\IndexService;
use App\Http\Requests\Admin\Service\StoreService;
use App\Http\Requests\Admin\Service\UpdateService;
use App\Models\ExaminationService;
use App\Models\Lab;
use App\Models\LabDetail;
use App\Models\LabDetailService;
use App\Models\Service;
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

class ServicesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexService $request
     * @return array|Factory|View
     */
    public function index(IndexService $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Service::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name'],

            // set columns to searchIn
            ['id', 'name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.service.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.service.create');
        $labs = Lab::with('labDetails')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'labDetails' => $item->labDetails->map(function ($value) use ($item) {
                    return [
                        'lab_detail_id' => $value->id,
                        'name' => $value->name,
                        'lab_id' => $item->id,
                    ];
                }),
            ];
        });
        return view('admin.service.create', [
            'labs' => $labs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreService $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreService $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Service
        $service = Service::create($sanitized);

        $service->labDetailService()->sync($request->lab_detail);



        if ($request->ajax()) {
            return ['redirect' => url('admin/services'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/services');
    }

    /**
     * Display the specified resource.
     *
     * @param Service $service
     * @throws AuthorizationException
     * @return void
     */
    public function show(Service $service)
    {
        $this->authorize('admin.service.show', $service);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Service $service)
    {
        $this->authorize('admin.service.edit', $service);


        // return $service->load('labDetailService');
        $data = [
            'id' => $service->load('labDetailService')->id,
            'name' => $service->load('labDetailService')->name,
            'price' => $service->load('labDetailService')->price,
            'created_at' => $service->load('labDetailService')->created_at,
            'updated_at' => $service->load('labDetailService')->updated_at,
            'resource_url' => $service->load('labDetailService')->resource_url,
            'lab_detail' => $service->load('labDetailService')->labDetailService->map(function ($item) {
                // return $item->id;
                return [
                    'lab_detail_id' => $item->id,
                    'lab_id' => $item->pivot->lab_id,
                ];
            })
        ];


        $labs = Lab::with('labDetails')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'labDetails' => $item->labDetails->map(function ($value) use ($item) {
                    return [
                        'lab_detail_id' => $value->id,
                        'name' => $value->name,
                        'lab_id' => $item->id,
                    ];
                }),
            ];
        });

        return view('admin.service.edit', [
            'service' => $data,
            'labs' => $labs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateService $request
     * @param Service $service
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateService $request, Service $service)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Service
        $service->update($sanitized);
        $service->labDetailService()->detach();
        $service->labDetailService()->sync($request->lab_detail);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/services'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyService $request
     * @param Service $service
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyService $request, Service $service)
    {
        $examinationService = ExaminationService::whereServiceId($service->id)->first();

        if (isset($examinationService)) {
            return response(['message' => 'Service ນີ້ຖືກນຳໃຊ້ແລ້ວບໍ່ສາມາດລົບໄດ້.'], 403);
        }

        $labDetailService = LabDetailService::whereServiceId($service->id)->first();

        if (isset($labDetailService)) {
            LabDetailService::whereServiceId($service->id)->delete();
        }

        $service->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyService $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyService $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Service::whereIn('id', $bulkChunk)->delete();

                    
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
