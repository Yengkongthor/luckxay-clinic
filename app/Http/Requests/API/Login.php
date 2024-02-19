<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class Login extends FormRequest
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
            'phone' => 'required|regex:/^\+856[0-9]{10}$/i',
            'password' => 'required|min:6',
            'device_info' => 'required',
        ];
    }
}
