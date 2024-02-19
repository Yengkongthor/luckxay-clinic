<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExcludeDate\BulkDestroyExcludeDate;
use App\Http\Requests\Admin\ExcludeDate\DestroyExcludeDate;
use App\Http\Requests\Admin\ExcludeDate\IndexExcludeDate;
use App\Http\Requests\Admin\ExcludeDate\StoreExcludeDate;
use App\Http\Requests\Admin\ExcludeDate\UpdateExcludeDate;
use App\Models\ExcludeDate;
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

class ExcludeDatesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexExcludeDate $request
     * @return array|Factory|View
     */
    public function index(IndexExcludeDate $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ExcludeDate::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['date', 'id'],

            // set columns to searchIn
            ['id']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.exclude-date.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.exclude-date.create');

        return view('admin.exclude-date.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExcludeDate $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreExcludeDate $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the ExcludeDate
        $excludeDate = ExcludeDate::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/booking-dates'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/exclude-dates');
    }

    /**
     * Display the specified resource.
     *
     * @param ExcludeDate $excludeDate
     * @throws AuthorizationException
     * @return void
     */
    public function show(ExcludeDate $excludeDate)
    {
        $this->authorize('admin.exclude-date.show', $excludeDate);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ExcludeDate $excludeDate
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(ExcludeDate $excludeDate)
    {
        $this->authorize('admin.exclude-date.edit', $excludeDate);


        return view('admin.exclude-date.edit', [
            'excludeDate' => $excludeDate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateExcludeDate $request
     * @param ExcludeDate $excludeDate
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateExcludeDate $request, ExcludeDate $excludeDate)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values ExcludeDate
        $excludeDate->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/booking-dates'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/exclude-dates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyExcludeDate $request
     * @param ExcludeDate $excludeDate
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyExcludeDate $request, ExcludeDate $excludeDate)
    {
        $excludeDate->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyExcludeDate $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyExcludeDate $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    ExcludeDate::whereIn('id', $bulkChunk)->delete();

                    
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
