<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpertiseUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'expertise_field_id' => ['required', 'numeric'],
            'detail' => ['required', 'string'],
            'years_of_experience' => ['required', 'numeric', 'min:1', 'max:50'],
            // Add other validation rules as needed
        ];
    }

    // Optionally, you can add custom error messages if required
    public function messages()
    {
        return [
            'expertise_field_id.required' => 'The expertise field ID is required.',
            'detail.required' => 'The expertise detail is required.',
            // Add custom error messages for other rules as needed
        ];
    }
}
