<?php

namespace App\Http\Requests\Admin\BookingTime;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreBookingTime extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.booking-time.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'start_time' => ['required', Rule::unique('booking_times')->where(function ($query) {
                return $query->where('start_time', $this->start_time)
                    ->where('end_time', $this->end_time);
            }), 'date_format:H:i:s'],
            'end_time' => ['required', Rule::unique('booking_times')->where(function ($query) {
                return $query->where('start_time', $this->start_time)
                    ->where('end_time', $this->end_time);
            }), 'date_format:H:i:s'],
            'status_time' => ['required', 'string'],

        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();

        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
