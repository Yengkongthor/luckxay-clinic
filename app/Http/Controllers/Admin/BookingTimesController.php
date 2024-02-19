<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookingTime\BulkDestroyBookingTime;
use App\Http\Requests\Admin\BookingTime\DestroyBookingTime;
use App\Http\Requests\Admin\BookingTime\IndexBookingTime;
use App\Http\Requests\Admin\BookingTime\StoreBookingTime;
use App\Http\Requests\Admin\BookingTime\UpdateBookingTime;
use App\Models\BookingTime;
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

class BookingTimesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexBookingTime $request
     * @return array|Factory|View
     */
    public function index(IndexBookingTime $request)
    {
        return view('admin.booking-time.index', ['data_morning' => $this->indexStatus($request, 'morning'), 'data_afternoon' => $this->indexStatus($request, 'afternoon')]);
    }

    public function indexStatus(IndexBookingTime $request, $status)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(BookingTime::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'start_time', 'end_time', 'status_time', 'status'],

            // set columns to searchIn
            ['id', 'status_time'],
            static function (Builder $query) use ($status) {
                $query->where('status_time', $status)->orderBy('start_time');
            }
        );

        if ($request->ajax()) {

            return ['data' => $data];
        }

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.booking-time.create');

        return view('admin.booking-time.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookingTime $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreBookingTime $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the BookingTime
        $bookingTime = BookingTime::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/booking-times'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/booking-times');
    }

    /**
     * Display the specified resource.
     *
     * @param BookingTime $bookingTime
     * @throws AuthorizationException
     * @return void
     */
    public function show(BookingTime $bookingTime)
    {
        $this->authorize('admin.booking-time.show', $bookingTime);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BookingTime $bookingTime
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(BookingTime $bookingTime)
    {
        $this->authorize('admin.booking-time.edit', $bookingTime);


        return view('admin.booking-time.edit', [
            'bookingTime' => $bookingTime,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookingTime $request
     * @param BookingTime $bookingTime
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateBookingTime $request, BookingTime $bookingTime)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values BookingTime
        $bookingTime->update($sanitized);


        if ($request->ajax()) {
            return [
                'redirect' => url('admin/booking-times'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/booking-times');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyBookingTime $request
     * @param BookingTime $bookingTime
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyBookingTime $request, BookingTime $bookingTime)
    {
        $bookingTime->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyBookingTime $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyBookingTime $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    BookingTime::whereIn('id', $bulkChunk)->delete();

                    
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
