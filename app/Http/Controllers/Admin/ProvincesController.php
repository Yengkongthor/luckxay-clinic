<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\District\IndexDistrict;
use App\Http\Requests\Admin\Province\BulkDestroyProvince;
use App\Http\Requests\Admin\Province\DestroyProvince;
use App\Http\Requests\Admin\Province\IndexProvince;
use App\Http\Requests\Admin\Province\StoreProvince;
use App\Http\Requests\Admin\Province\UpdateProvince;
use App\Models\District;
use App\Models\Province;
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

class ProvincesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexProvince $request
     * @return array|Factory|View
     */
    public function index(IndexProvince $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Province::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['en_name', 'id', 'la_name'],

            // set columns to searchIn
            ['en_name', 'id', 'la_name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.province.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.province.create');

        return view('admin.province.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProvince $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreProvince $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Province
        $province = Province::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/provinces'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/provinces');
    }

    /**
     * Display the specified resource.
     *
     * @param Province $province
     * @throws AuthorizationException
     * @return void
     */
    public function show(Province $province)
    {
        $this->authorize('admin.province.show', $province);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Province $province
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Province $province, IndexDistrict $request)
    {
        $this->authorize('admin.province.edit', $province);


        return view('admin.province.edit', [
            'province' => $province,
            'data' => $this->getDistrict($request, $province->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProvince $request
     * @param Province $province
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateProvince $request, Province $province)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Province
        $province->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/provinces'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/provinces');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyProvince $request
     * @param Province $province
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyProvince $request, Province $province)
    {
        $province->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyProvince $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyProvince $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Province::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexDistrict $request
     * @return array|Factory|View
     */
    public function getDistrict(IndexDistrict $request, $province_id)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(District::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'province_id'],

            // set columns to searchIn
            ['id', 'name'],
            static function (Builder $query) use ($province_id) {
                $query->where('province_id', $province_id);
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
    public function getDistrictInprovince($id)
    {
        $districts = District::where('province_id', $id)->get();

        return $districts;
    }
}
