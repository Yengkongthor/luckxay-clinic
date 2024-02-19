<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\API\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookAnAppointment\BulkDestroyBookAnAppointment;
use App\Http\Requests\Admin\BookAnAppointment\DestroyBookAnAppointment;
use App\Http\Requests\Admin\BookAnAppointment\IndexBookAnAppointment;
use App\Http\Requests\Admin\BookAnAppointment\StoreBookAnAppointment;
use App\Http\Requests\Admin\BookAnAppointment\UpdateBookAnAppointment;
use App\Http\Requests\API\GetTime;
use App\Models\BookAnAppointment;
use App\Models\User;
use App\Utils\DateTimeUtil;
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

class BookAnAppointmentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexBookAnAppointment $request
     * @return array|Factory|View
     */
    public function index(IndexBookAnAppointment $request)
    {
        $sanitized = $request->getSanitized();

        $monthEvents = $sanitized['type'] != 'date' ?  BookAnAppointment::orderBy('booking_date')
            ->whereYear('booking_date', $sanitized['year'])
            ->whereMonth('booking_date', $sanitized['month'])
            ->get()->map(function ($item, $key) {
                return [
                    'title' => DateTimeUtil::timeFormat($item->time->start_time),
                    'date' => $item->booking_date,
                    'color' => '', // set bg color for cancel, complete
                ];
            }) : [];

        $dateEvents = $sanitized['type'] != 'month' ? BookAnAppointment::orderBy('booking_date')
            ->whereDate('booking_date', $sanitized['date'])
            ->get()->map(function ($item, $key) {
                return [
                    'user_id' => $item->user ? $item->user->id : null,
                    'name' => $item->user->full_name,
                    'time' => DateTimeUtil::timeFormat($item->time->start_time),
                    'purpose' => $item->purpose,
                    'resource_url' => $item->resource_url,
                    'status' => $item->status,
                    'tel' => $item->user->phone,
                    'id' => $item->id,
                    'patient_id' => $item->user->patient->id,

                ];
            })->sortBy('time')->values()->all() : [];

        $data = collect([
            'monthEvents' => $monthEvents,
            'dateEvents' => $dateEvents,
        ]);

        if ($request->ajax()) {
            return ['data' => $data];
        }
        // return $data;
        return view('admin.book-an-appointment.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.book-an-appointment.create');

        return view('admin.book-an-appointment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookAnAppointment $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreBookAnAppointment $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the BookAnAppointment
        $bookAnAppointment = BookAnAppointment::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/book-an-appointments'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/book-an-appointments');
    }

    /**
     * Display the specified resource.
     *
     * @param BookAnAppointment $bookAnAppointment
     * @throws AuthorizationException
     * @return void
     */
    public function show(BookAnAppointment $bookAnAppointment)
    {
        $this->authorize('admin.book-an-appointment.show', $bookAnAppointment);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BookAnAppointment $bookAnAppointment
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(BookAnAppointment $bookAnAppointment)
    {
        $this->authorize('admin.book-an-appointment.edit', $bookAnAppointment);


        return view('admin.book-an-appointment.edit', [
            'bookAnAppointment' => $bookAnAppointment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookAnAppointment $request
     * @param BookAnAppointment $bookAnAppointment
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateBookAnAppointment $request, BookAnAppointment $bookAnAppointment)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values BookAnAppointment
        $bookAnAppointment->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/book-an-appointments'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/book-an-appointments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyBookAnAppointment $request
     * @param BookAnAppointment $bookAnAppointment
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyBookAnAppointment $request, BookAnAppointment $bookAnAppointment)
    {
        $bookAnAppointment->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    public function getTimes(GetTime $request)
    {
        $data = (new Appointment())->times($request);
        $data['data']['users'] = User::all();
        return $data;
    }
}
