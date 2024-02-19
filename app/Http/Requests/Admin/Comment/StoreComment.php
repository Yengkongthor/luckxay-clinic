<?php

namespace App\Http\Requests\Admin\Comment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreComment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.examination-service.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'queue_id' => ['required', 'integer'],
            'body' => ['required', 'string'],
            'status_doctor_medicine' => ['required'],
            'doctor_fee' => ['required'],
            'doctor_fee_discount' => ['required'],
            // 'medicine_name' => ['required', 'string'],
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

        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
