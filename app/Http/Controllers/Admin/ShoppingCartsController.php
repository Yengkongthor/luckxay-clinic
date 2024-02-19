<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShoppingCart\BulkDestroyShoppingCart;
use App\Http\Requests\Admin\ShoppingCart\DestroyShoppingCart;
use App\Http\Requests\Admin\ShoppingCart\IndexShoppingCart;
use App\Http\Requests\Admin\ShoppingCart\StoreShoppingCart;
use App\Http\Requests\Admin\ShoppingCart\UpdateShoppingCart;
use App\Models\ShoppingCart;
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

class ShoppingCartsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexShoppingCart $request
     * @return array|Factory|View
     */
    public function index(IndexShoppingCart $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ShoppingCart::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'medicine_id', 'cost', 'price', 'amount'],

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

        return view('admin.shopping-cart.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.shopping-cart.create');

        return view('admin.shopping-cart.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreShoppingCart $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreShoppingCart $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the ShoppingCart
        $shoppingCart = ShoppingCart::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/shopping-carts'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/shopping-carts');
    }

    /**
     * Display the specified resource.
     *
     * @param ShoppingCart $shoppingCart
     * @throws AuthorizationException
     * @return void
     */
    public function show(ShoppingCart $shoppingCart)
    {
        $this->authorize('admin.shopping-cart.show', $shoppingCart);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ShoppingCart $shoppingCart
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(ShoppingCart $shoppingCart)
    {
        $this->authorize('admin.shopping-cart.edit', $shoppingCart);


        return view('admin.shopping-cart.edit', [
            'shoppingCart' => $shoppingCart,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateShoppingCart $request
     * @param ShoppingCart $shoppingCart
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateShoppingCart $request, ShoppingCart $shoppingCart)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values ShoppingCart
        $shoppingCart->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/shopping-carts'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/shopping-carts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyShoppingCart $request
     * @param ShoppingCart $shoppingCart
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyShoppingCart $request, ShoppingCart $shoppingCart)
    {
        $shoppingCart->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyShoppingCart $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyShoppingCart $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    ShoppingCart::whereIn('id', $bulkChunk)->delete();

                    
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
