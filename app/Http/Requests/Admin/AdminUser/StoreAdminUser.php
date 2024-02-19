<?php

namespace App\Http\Requests\Admin\AdminUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StoreAdminUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('admin.admin-user.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('admin_users', 'email'), 'string'],
            'password' => ['required', 'confirmed', 'min:7', 'string'],
            'forbidden' => ['required', 'boolean'],
            'language' => ['required', 'string'],
            'employee' => [
                'branch_id' => ['sometimes', 'integer'],
                'lab_id' => ['sometimes', 'array'],
                'department_code' => ['required', 'string'],
                'lao_first_name' => ['required', 'string'],
                'lao_last_name' => ['required', 'string'],
                'position' => ['required', 'string'],
                'phone' => ['required', 'string', Rule::unique('employees', 'phone')],
            ],

            'roles' => ['array'],

        ];

        if (Config::get('admin-auth.activation_enabled')) {
            $rules['activated'] = ['required', 'boolean'];
        }

        return $rules;
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getModifiedData(): array
    {
        $data = $this->only(collect($this->rules())->keys()->all());
        if (!Config::get('admin-auth.activation_enabled')) {
            $data['activated'] = true;
        }
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $data;
    }
}
