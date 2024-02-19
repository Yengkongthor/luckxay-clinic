<?php

namespace App\Http\Requests\Admin\Medicine;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateMedicine extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.medicine.edit', $this->medicine);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'cheminal_name' => ['required', 'string'],
            'dose' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'brand' => ['required'],
            'category' => ['required'],
            'min_amount' => ['required'],

        ];
    }

    public function getBrandId()
    {
        if ($this->has('brand')) {
            return $this->get('brand')['id'];
        }
        return null;
    }

    public function getCategoryId()
    {
        if ($this->has('category')) {
            return $this->get('category')['id'];
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
