<?php

namespace App\Http\Requests\Admin\MedicinePricing;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateMedicinePricing extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.medicine-pricing.edit', $this->medicinePricing);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'amount' => ['sometimes', 'integer'],
            'base_price' => ['sometimes', 'numeric'],
            'best_before_date' => ['nullable', 'date'],
            'manufacture_date' => ['nullable', 'date'],
            'medicine' => ['sometimes'],

        ];
    }


    public function getMedicineId()
    {
        if ($this->has('medicine')) {
            return $this->get('medicine')['id'];
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
