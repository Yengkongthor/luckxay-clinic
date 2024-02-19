<?php

namespace App\Http\Requests\Admin\ExamPackage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateExamPackage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.exam-package.edit', $this->examPackage);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'employee_id' => ['nullable', 'integer'],
            'package_id' => ['sometimes', 'integer'],
            'status' => ['sometimes', 'string'],
            'body' => ['sometimes'],

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

        $sanitized['medicine_name'] = '';
        $sanitized['body'] = '';
        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
