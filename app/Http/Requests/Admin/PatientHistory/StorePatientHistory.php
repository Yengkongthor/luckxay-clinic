<?php

namespace App\Http\Requests\Admin\PatientHistory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StorePatientHistory extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.patient-history.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer'],
            'lab_detail' => ['sometimes', 'array'],
            'service_id' => ['sometimes', 'array'],
            'queue_id' => ['sometimes', 'integer'],
            'info' => ['sometimes'],
            'status_add_edit' => ['sometimes'],
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
