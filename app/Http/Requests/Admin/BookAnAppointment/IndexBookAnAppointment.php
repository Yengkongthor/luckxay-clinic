<?php

namespace App\Http\Requests\Admin\BookAnAppointment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class IndexBookAnAppointment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.book-an-appointment.index');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'year' => 'string|nullable',
            'month' => 'string|nullable',
            'date' => 'date|nullable',
            'type' => 'string|nullable',
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

        $now = now();

        $sanitized['year'] = $sanitized['year'] ?? $now->year;
        $sanitized['month'] = $sanitized['month'] ?? $now->month;
        $sanitized['date'] = $sanitized['date'] ?? $now->format('Y-m-d');
        $sanitized['type'] = isset($sanitized['type']) ? $sanitized['type'] : 'all';

        return $sanitized;
    }
}
