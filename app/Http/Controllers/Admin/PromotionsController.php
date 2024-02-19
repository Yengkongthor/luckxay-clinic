<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Promotion\BulkDestroyPromotion;
use App\Http\Requests\Admin\Promotion\DestroyPromotion;
use App\Http\Requests\Admin\Promotion\IndexPromotion;
use App\Http\Requests\Admin\Promotion\StorePromotion;
use App\Http\Requests\Admin\Promotion\UpdatePromotion;
use App\Models\Promotion;
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

class PromotionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexPromotion $request
     * @return array|Factory|View
     */
    public function index(IndexPromotion $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Promotion::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'short_desc', 'link'],

            // set columns to searchIn
            ['id', 'name', 'short_desc', 'link']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.promotion.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.promotion.create');

        return view('admin.promotion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePromotion $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StorePromotion $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Promotion
        $promotion = Promotion::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/promotions'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/promotions');
    }

    /**
     * Display the specified resource.
     *
     * @param Promotion $promotion
     * @throws AuthorizationException
     * @return void
     */
    public function show(Promotion $promotion)
    {
        $this->authorize('admin.promotion.show', $promotion);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Promotion $promotion
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Promotion $promotion)
    {
        $this->authorize('admin.promotion.edit', $promotion);


        return view('admin.promotion.edit', [
            'promotion' => $promotion,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePromotion $request
     * @param Promotion $promotion
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdatePromotion $request, Promotion $promotion)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Promotion
        $promotion->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/promotions'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/promotions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyPromotion $request
     * @param Promotion $promotion
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyPromotion $request, Promotion $promotion)
    {
        $promotion->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyPromotion $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyPromotion $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Promotion::whereIn('id', $bulkChunk)->delete();

                    
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
