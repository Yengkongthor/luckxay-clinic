<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class Book extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'booking_date' => ['required', 'date'],
            'booking_time' => ['required', 'integer'],
            'purpose' => ['nullable', 'string'],
        ];
    }
}
