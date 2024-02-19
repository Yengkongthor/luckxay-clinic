<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Wage\BulkDestroyWage;
use App\Http\Requests\Admin\Wage\DestroyWage;
use App\Http\Requests\Admin\Wage\IndexWage;
use App\Http\Requests\Admin\Wage\StoreWage;
use App\Http\Requests\Admin\Wage\UpdateWage;
use App\Models\Wage;
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

class WagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexWage $request
     * @return array|Factory|View
     */
    public function index(IndexWage $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Wage::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'price'],

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

        return view('admin.wage.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.wage.create');

        return view('admin.wage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWage $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreWage $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Wage
        $wage = Wage::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/wages'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/wages');
    }

    /**
     * Display the specified resource.
     *
     * @param Wage $wage
     * @throws AuthorizationException
     * @return void
     */
    public function show(Wage $wage)
    {
        $this->authorize('admin.wage.show', $wage);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Wage $wage
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Wage $wage)
    {
        $this->authorize('admin.wage.edit', $wage);


        return view('admin.wage.edit', [
            'wage' => $wage,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWage $request
     * @param Wage $wage
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateWage $request, Wage $wage)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Wage
        $wage->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/wages'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/wages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyWage $request
     * @param Wage $wage
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyWage $request, Wage $wage)
    {
        $wage->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyWage $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyWage $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Wage::whereIn('id', $bulkChunk)->delete();

                    
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
