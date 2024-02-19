<?php

namespace App\Http\Requests\Admin\DoctorMedicine;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreDoctorMedicine extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.doctor-medicine.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'amount' => ['required', 'integer'],
            'cheminal_name' => ['required', 'string'],
            'patient_history_id' => ['required', 'integer'],
            'times' => ['required'],
            'tablets' => ['required'],
            'dose' => ['required'],
            'use' => ['required'],
            'type' => ['required'],
            'medicine_id' => ['required'],
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
