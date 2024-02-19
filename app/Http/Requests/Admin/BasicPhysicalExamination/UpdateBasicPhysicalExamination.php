<?php

namespace App\Http\Requests\Admin\BasicPhysicalExamination;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateBasicPhysicalExamination extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.basic-physical-examination.edit', $this->basicPhysicalExamination);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'patient_id' => ['sometimes', 'integer'],
            'pressure' => ['sometimes', 'numeric'],
            'weight' => ['sometimes', 'numeric'],
            'temperature' => ['sometimes', 'numeric'],
            // 'ta' => ['required', 'string'],
            'spo2' => ['required', 'string'],
            // 'pr' => ['required', 'string'],
            'bp' => ['required', 'string'],
            'rr' => ['required', 'string'],
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
