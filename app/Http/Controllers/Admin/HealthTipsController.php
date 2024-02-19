<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HealthTip\BulkDestroyHealthTip;
use App\Http\Requests\Admin\HealthTip\DestroyHealthTip;
use App\Http\Requests\Admin\HealthTip\IndexHealthTip;
use App\Http\Requests\Admin\HealthTip\StoreHealthTip;
use App\Http\Requests\Admin\HealthTip\UpdateHealthTip;
use App\Models\HealthTip;
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

class HealthTipsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexHealthTip $request
     * @return array|Factory|View
     */
    public function index(IndexHealthTip $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(HealthTip::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'title', 'short_desc'],

            // set columns to searchIn
            ['id', 'title', 'short_desc', 'detail']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.health-tip.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.health-tip.create');

        return view('admin.health-tip.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreHealthTip $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreHealthTip $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the HealthTip
        $healthTip = HealthTip::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/health-tips'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/health-tips');
    }

    /**
     * Display the specified resource.
     *
     * @param HealthTip $healthTip
     * @throws AuthorizationException
     * @return void
     */
    public function show(HealthTip $healthTip)
    {
        $this->authorize('admin.health-tip.show', $healthTip);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param HealthTip $healthTip
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(HealthTip $healthTip)
    {
        $this->authorize('admin.health-tip.edit', $healthTip);


        return view('admin.health-tip.edit', [
            'healthTip' => $healthTip,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateHealthTip $request
     * @param HealthTip $healthTip
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateHealthTip $request, HealthTip $healthTip)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values HealthTip
        $healthTip->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/health-tips'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/health-tips');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyHealthTip $request
     * @param HealthTip $healthTip
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyHealthTip $request, HealthTip $healthTip)
    {
        $healthTip->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyHealthTip $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyHealthTip $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    HealthTip::whereIn('id', $bulkChunk)->delete();

                    
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
