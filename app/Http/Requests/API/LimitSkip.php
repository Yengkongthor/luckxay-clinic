<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class LimitSkip extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'limit' => ['integer'],
            'skip' => ['integer'],
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
        $sanitized['limit'] = $sanitized['limit'] ?? 10;
        $sanitized['limit'] = $sanitized['limit'] <= 30 ? $sanitized['limit'] : 10;
        $sanitized['skip'] = $sanitized['skip'] ?? 0;

        return $sanitized;
    }
}
