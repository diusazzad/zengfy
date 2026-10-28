<?php

namespace Modules\Organization\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:100', 'alpha_dash', 'unique:organizations,slug'],
            'domain_type' => ['nullable', 'string', 'in:school,law_firm,retail_pos,clinic,enterprise'],
            'settings' => ['nullable', 'array'],
        ];
    }
}
