<?php

namespace App\Http\Requests\Admin\PatientHistory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdatePatientHistory extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.patient-history.edit', $this->patientHistory);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'patient' => ['sometimes'],
            'weight' => ['sometimes', 'numeric'],
            'temperature' => ['sometimes', 'numeric'],
            'test_at' => ['sometimes', 'date'],

        ];
    }

    public function getPatientId()
    {
        if ($this->has('patient')) {
            return $this->get('patient')['id'];
        }
        return null;
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
