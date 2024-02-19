<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profit\BulkDestroyProfit;
use App\Http\Requests\Admin\Profit\DestroyProfit;
use App\Http\Requests\Admin\Profit\IndexProfit;
use App\Http\Requests\Admin\Profit\StoreProfit;
use App\Http\Requests\Admin\Profit\UpdateProfit;
use App\Models\PrescribeMedicineDetail;
use App\Models\Profit;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProfitController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexProfit $request
     * @return array|Factory|View
     */
    public function index(Request $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(PrescribeMedicineDetail::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            [
                'id',
                'amount',
                'name',
                'prescribe_medicine_id',
                'price',
                'medicine_id',
            ],

            // set columns to searchIn
            [
                'id',

                'amount',
                'name',
                'prescribe_medicine_id',
                'price',
                'medicine_id',
            ],
            static function (Builder $q) use ($request) {
                $q->where('status', 'lab_detail');
                $q->with(['prescribeMedicine', 'labDetail'])->orderByDesc('id');

                if ($request->startDate && $request->endDate) {
                    $q->whereBetween('created_at', [$request->startDate, $request->endDate . ' 23:59:59']);
                }
            }
        );

        $total = 0;

        if ($request->startDate && $request->endDate) {

            foreach (PrescribeMedicineDetail::where('status', 'lab_detail')->whereBetween('created_at', [$request->startDate, $request->endDate . ' 23:59:59'])->get() as $key => $value) {
                $total += ($value->labDetail ? $value->labDetail->price : 0) - ($value->labDetail ? $value->labDetail->cose : 0);
            }
        } else {

            foreach (PrescribeMedicineDetail::where('status', 'lab_detail')->get() as $key => $value) {
                $total += ($value->labDetail ? $value->labDetail->price : 0) - ($value->labDetail ? $value->labDetail->cose : 0);
            }
        }



        $data = collect($data);
        $data['data'] = [
            'prescribeMedicineDetail' => $data['data'],
            'total' => $total,
        ];

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.profit.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.profit.create');

        return view('admin.profit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProfit $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreProfit $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Profit
        $profit = Profit::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/profits'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/profits');
    }

    /**
     * Display the specified resource.
     *
     * @param Profit $profit
     * @throws AuthorizationException
     * @return void
     */
    public function show(Profit $profit)
    {
        $this->authorize('admin.profit.show', $profit);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Profit $profit
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Profit $profit)
    {
        $this->authorize('admin.profit.edit', $profit);


        return view('admin.profit.edit', [
            'profit' => $profit,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfit $request
     * @param Profit $profit
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateProfit $request, Profit $profit)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Profit
        $profit->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/profits'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/profits');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyProfit $request
     * @param Profit $profit
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyProfit $request, Profit $profit)
    {
        $profit->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyProfit $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyProfit $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Profit::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
