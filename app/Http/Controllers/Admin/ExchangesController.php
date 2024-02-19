<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Exchange\BulkDestroyExchange;
use App\Http\Requests\Admin\Exchange\DestroyExchange;
use App\Http\Requests\Admin\Exchange\IndexExchange;
use App\Http\Requests\Admin\Exchange\StoreExchange;
use App\Http\Requests\Admin\Exchange\UpdateExchange;
use App\Models\Exchange;
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

class ExchangesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexExchange $request
     * @return array|Factory|View
     */
    public function index(IndexExchange $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Exchange::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'thb', 'usd'],

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

        return view('admin.exchange.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.exchange.create');

        return view('admin.exchange.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExchange $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreExchange $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Exchange
        $exchange = Exchange::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/exchanges'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/exchanges');
    }

    /**
     * Display the specified resource.
     *
     * @param Exchange $exchange
     * @throws AuthorizationException
     * @return void
     */
    public function show(Exchange $exchange)
    {
        $this->authorize('admin.exchange.show', $exchange);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Exchange $exchange
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Exchange $exchange)
    {
        $this->authorize('admin.exchange.edit', $exchange);


        return view('admin.exchange.edit', [
            'exchange' => $exchange,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateExchange $request
     * @param Exchange $exchange
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateExchange $request, Exchange $exchange)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Exchange
        $exchange->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/exchanges'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/exchanges');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyExchange $request
     * @param Exchange $exchange
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyExchange $request, Exchange $exchange)
    {
        $exchange->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyExchange $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyExchange $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Exchange::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
