<?php

namespace App\Http\Requests\Admin\ExaminationService;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateExaminationService extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.examination-service.edit', $this->examinationService);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'patient_history_id' => ['sometimes', 'integer'],
            'service_id' => ['sometimes', 'integer'],
            'lab_id' => ['sometimes', 'integer'],
            'lab_detail_id' => ['sometimes', 'integer'],
            'value' => ['nullable'],

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

        $sanitized['input_status'] = 0;
        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
