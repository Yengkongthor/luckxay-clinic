<?php

namespace App\Http\Requests\Admin\LabDetail;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateLabDetail extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.lab-detail.edit', $this->labDetail);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'lab_id' => ['sometimes', 'integer'],
            'name' => ['sometimes', 'string'],
            'unit' => ['sometimes', 'string'],
            'reference' => ['sometimes', 'string'],
            'cost' => ['sometimes', 'numeric'],
            'price' => ['sometimes', 'numeric'],
            
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
