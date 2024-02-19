<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\Book;
use App\Http\Requests\API\CancelAppointment;
use App\Http\Requests\API\GetTime;
use App\Http\Requests\API\LimitSkip;
use App\Http\Resources\Appointment as ResourcesAppointment;
use App\Models\AppointmentCancel;
use App\Models\BookAnAppointment;
use App\Models\BookingDate;
use App\Models\BookingTime;
use App\Models\ExcludeDate;
use App\Utils\DateTimeUtil;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Log;

class Appointment extends AppBaseController
{
    public function lists(LimitSkip $request)
    {
        $sanitized = $request->getSanitized();

        $before = now()->subDays(3)->format('Y-m-d');
        $appointments = Auth::user()->appointments()
            ->where('booking_date', '>=', $before)
            ->limit($sanitized['limit'])
            ->skip($sanitized['skip'])
            ->get();
        return ResourcesAppointment::collection($appointments);
    }

    public function book(Book $request)
    {
        $input = $request->validated();
        $input['user_id'] = auth()->user()->id;
        $book = BookAnAppointment::create($input);
        return $this->sendResponse([], '');
    }

    public function date()
    {
        $bookingDate = BookingDate::get()->last();
        $lastDate = $bookingDate ? $bookingDate->last_date : 30;

        $period = now()->toPeriod($lastDate);

        $first = $period->first();
        $last = $period->last();


        $excludes = ExcludeDate::whereBetween('date', [$first->format('Y-m-d'), $last->format('Y-m-d')])->get()->map(function ($item) {
            return $item->date->format('Y-m-d');
        });

        $dates = [];
        $period->forEach(function (Carbon $date) use (&$dates, $excludes) {
            $date = $date->format('Y-m-d');
            if (!in_array($date, $excludes->toArray())) $dates[] = $date;
        });

        return $this->sendResponse(
            [
                'first_date' => $dates[0],
                'last_date' => $dates[count($dates) - 1],
                'exclude_dates' => $excludes,
            ],
            ''
        );
    }

    public function times(GetTime $request)
    {
        $now = now();

        $bookAnAppointment = BookAnAppointment::whereBookingDate($request->date)->pluck('booking_time')->toArray();

        $bookingTimeMorning = BookingTime::whereStatusTime('morning')->get();

        $bookingTimeMorning =   $bookingTimeMorning->map(function ($item, $key) use ($bookAnAppointment, $now, $request) {
            return [
                'id' => (string) $item->id,
                'time' => DateTimeUtil::timeFormat($item->start_time) . ' - ' . DateTimeUtil::timeFormat($item->end_time),
                'off' =>  $item->status == 0 ? true
                    : (!in_array($item->id, $bookAnAppointment) && $now->floatDiffInHours($request->date . ' ' . $item->start_time, false) > 0  ? false : true),
            ];
        });

        $bookingTimeAfternoon = BookingTime::whereStatusTime('afternoon')->get();

        $bookingTimeAfternoon =   $bookingTimeAfternoon->map(function ($item, $key) use ($bookAnAppointment, $request, $now) {
            return [
                'id' => (string) $item->id,
                'time' => DateTimeUtil::timeFormat($item->start_time) . ' - ' . DateTimeUtil::timeFormat($item->end_time),
                'off' => $item->status == 0 ? true
                    : (!in_array($item->id, $bookAnAppointment) && $now->floatDiffInHours($request->date . ' ' . $item->start_time, false) > 0  ? false : true),
            ];
        });

        $response = [
            'morning_times' => $bookingTimeMorning,
            'afternoon_times' => $bookingTimeAfternoon,
        ];

        return ['data' => $response];
        // return $this->sendResponse($response, '');
    }

    public function cancel(CancelAppointment $request, BookAnAppointment $bookAnAppointment)
    {
        DB::transaction(function () use ($request, $bookAnAppointment) {
            AppointmentCancel::create([
                'user_id' => $bookAnAppointment->user_id,
                'booking_date' => $bookAnAppointment->booking_date,
                'booking_time' => $bookAnAppointment->booking_time,
                'reason' => $request->reason,
            ]);

            $bookAnAppointment->delete();
        });

        return $this->sendResponse([], '');
    }
}
