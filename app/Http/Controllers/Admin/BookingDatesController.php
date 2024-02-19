<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookingDate\BulkDestroyBookingDate;
use App\Http\Requests\Admin\BookingDate\DestroyBookingDate;
use App\Http\Requests\Admin\BookingDate\IndexBookingDate;
use App\Http\Requests\Admin\BookingDate\StoreBookingDate;
use App\Http\Requests\Admin\BookingDate\UpdateBookingDate;
use App\Http\Requests\Admin\ExcludeDate\IndexExcludeDate;
use App\Models\BookingDate;
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
use Log;

class BookingDatesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexBookingDate $request
     * @return array|Factory|View
     */
    public function index(IndexExcludeDate $requestExclude)
    {
        $bookingDate = BookingDate::first();


        if (!isset($bookingDate)) {
            $bookingDate = [
                'id' => '',
                'last_date' => '',
                'resource_url' => '/admin/booking-dates',
            ];
        }

        return view('admin.booking-date.index', [
            'bookingDate' => $bookingDate,
            'dataExcludeData' => $this->getExcludeData($requestExclude)
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @param IndexExcludeDate $request
     * @return array|Factory|View
     */
    public function getExcludeData(IndexExcludeDate $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ExcludeDate::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'date'],

            // set columns to searchIn
            ['id']
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
        $this->authorize('admin.booking-date.create');

        return view('admin.booking-date.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookingDate $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreBookingDate $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the BookingDate
        $bookingDate = BookingDate::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/booking-dates'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/booking-dates');
    }

    /**
     * Display the specified resource.
     *
     * @param BookingDate $bookingDate
     * @throws AuthorizationException
     * @return void
     */
    public function show(BookingDate $bookingDate)
    {
        $this->authorize('admin.booking-date.show', $bookingDate);

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BookingDate $bookingDate
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(BookingDate $bookingDate)
    {
        $this->authorize('admin.booking-date.edit', $bookingDate);


        return view('admin.booking-date.edit', [
            'bookingDate' => $bookingDate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookingDate $request
     * @param BookingDate $bookingDate
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateBookingDate $request, BookingDate $bookingDate)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values BookingDate
        $bookingDate->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/booking-dates'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/booking-dates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyBookingDate $request
     * @param BookingDate $bookingDate
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyBookingDate $request, BookingDate $bookingDate)
    {
        $bookingDate->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyBookingDate $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyBookingDate $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    BookingDate::whereIn('id', $bulkChunk)->delete();

                    
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
