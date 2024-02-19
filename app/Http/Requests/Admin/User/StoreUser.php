<?php

namespace App\Http\Requests\Admin\User;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Str;

class StoreUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('admin.user.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', Rule::unique('users')->where(function ($query) {
                return $query->where('name', $this->name)
                    ->where('surname', $this->surname);
            })],
            'surname' => ['required', 'string', Rule::unique('users')->where(function ($query) {
                return $query->where('name', $this->name)
                    ->where('surname', $this->surname);
            })],
            'email' => ['nullable', 'string'],

            'patient.lao_first_name' => ['nullable', 'string', Rule::unique('patients', 'lao_first_name')->where(function ($query) {
                return $query->where('lao_first_name', $this->patient['lao_first_name'])
                    ->where('lao_last_name', $this->patient['lao_last_name']);
            })],
            'patient.lao_last_name' => ['nullable', 'string', Rule::unique('patients', 'lao_last_name')->where(function ($query) {
                return $query->where('lao_first_name', $this->patient['lao_first_name'])
                    ->where('lao_last_name', $this->patient['lao_last_name']);
            })],
            'patient.nick_name' => ['nullable', 'string'],
            'patient.birth_date' => ['nullable', 'date'],
            'patient.gender' => ['nullable', 'string'],

            'patient.marital_status' => ['nullable', 'string'],
            'patient.blood_group' => ['nullable', 'string'],
            'patient.village' => ['nullable', 'string'],
            'patient.district' => ['nullable', 'string'],
            'patient.province' => ['nullable'],
            'patient.diseases_history' => ['nullable', 'string'],
            'patient.medicine_history' => ['nullable', 'string'],
            'patient.drug_allergy_or_food' => ['nullable', 'boolean'],
            'patient.drug_or_food' => ['nullable', 'string'],
            'patient.job' => ['nullable', 'string'],
            'patient.salary' => ['nullable', 'string'],
            'patient.sos' => ['nullable', 'string'],
            'phone' => ['required', Rule::unique('users', 'phone'), 'string'],
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
        // if (!empty($data['password'])) {
        $data['password'] = Hash::make(Str::random(8));
        // }



        $data['patient']['nick_name'] = $data['patient']['nick_name'] ?? '';
        $data['patient']['birth_date'] = $data['patient']['birth_date'] ?? '0000-00-00 00:00:00';
        $data['patient']['gender'] = $data['patient']['gender'] ?? '';
        $data['patient']['age'] = $data['patient']['birth_date'] ?  Carbon::create($data['patient']['birth_date'])->diff(Carbon::now())->format('%y') : 0;
        $data['patient']['marital_status'] = $data['patient']['marital_status'] ?? '';
        $data['patient']['blood_group'] = $data['patient']['blood_group'] ?? '';
        $data['patient']['village'] = $data['patient']['village'] ?? '';
        $data['patient']['district'] = $data['patient']['district'] ?? '';
        $data['patient']['province'] = $data['patient']['province'] ? $data['patient']['province']['en_name'] : null;
        $data['patient']['diseases_history'] = $data['patient']['diseases_history'] ?? '';
        $data['patient']['medicine_history'] = $data['patient']['medicine_history'] ?? '';
        $data['patient']['drug_allergy_or_food'] = $data['patient']['drug_allergy_or_food'] ?? '';
        $data['patient']['drug_or_food'] = $data['patient']['drug_or_food'] ?? '';
        $data['patient']['job'] = $data['patient']['job'] ?? '';
        $data['patient']['salary'] = $data['patient']['salary'] ?? '';


        return $data;
    }
}
