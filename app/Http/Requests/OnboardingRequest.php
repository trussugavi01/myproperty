<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OnboardingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'phone' => ['required', 'string', 'max:20'],
        ];

        $role = $this->user()->role;

        if (in_array($role, ['landlord', 'developer'])) {
            $rules['company_name'] = ['required', 'string', 'max:255'];
            $rules['bio'] = ['nullable', 'string'];
            $rules['address'] = ['required', 'string'];
            $rules['city'] = ['required', 'string', 'max:255'];
            $rules['state'] = ['required', 'string', 'max:255'];
        }

        if ($role === 'developer') {
            $rules['website'] = ['nullable', 'url', 'max:255'];
            $rules['years_in_business'] = ['nullable', 'integer', 'min:0'];
        }

        if ($role === 'landlord') {
            $rules['preferred_contact_method'] = ['required', 'in:email,phone,both'];
        }

        return $rules;
    }
}
