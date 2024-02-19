<?php

namespace App\Http\Requests\API;

use Hash;
use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
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
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required|regex:/^\+856[0-9]{10}$/i',
            'password' => 'required|min:6',
            'device_info' => 'required',
            'token' => 'required',
        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getModifiedData(): array
    {
        $data = $this->only(collect($this->rules())->keys()->all());
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $data['email'] = $data['phone'];
        return $data;
    }
}
