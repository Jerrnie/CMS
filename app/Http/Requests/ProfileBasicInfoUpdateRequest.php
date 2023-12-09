<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileBasicInfoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'dob' => ['nullable', 'date'],
            'sex' => ['nullable', 'string', 'in:male,female,other'],
            'country' => ['nullable', 'string', 'max:255'],
            'citizenship' => ['nullable', 'string', 'max:255'],
            'gov_id_type' => ['nullable', 'string', 'max:255'],
            'gov_id_number' => ['nullable', 'string', 'max:255'],
        ];
    }
}
