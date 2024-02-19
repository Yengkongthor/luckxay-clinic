<?php

namespace App\Http\Requests\Admin\Province;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateProvince extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.province.edit', $this->province);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'en_name' => ['sometimes', Rule::unique('provinces', 'en_name')->ignore($this->province->getKey(), $this->province->getKeyName()), 'string'],
            'la_name' => ['sometimes', Rule::unique('provinces', 'la_name')->ignore($this->province->getKey(), $this->province->getKeyName()), 'string'],
            
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
