<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileConsultantinfoUpdateRequest extends FormRequest
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
            'years_experience' => 'required|numeric|min:0|max:50',
            'consulting_category' => 'required' ,
            'relatives_at_zff' => 'required',
            'zff_staff_relative_name' => 'required_if:relatives_at_zff,yes',
            'zff_staff_partner' => 'required',
            'partner_name' => 'required_if:zff_staff_partner,1,2',
            'partner_position_title' => 'required_if:zff_staff_partner,1,2',
            'partner_employee_number' => 'required_if:zff_staff_partner,1,2',
            'zff_staff' => 'required',
            'position_title'  => 'required_if:zff_staff,yes',
            'employee_number' => 'required_if:zff_staff,yes',
            'employment_end_date' => 'required_if:zff_staff,yes',
            'director_or_above' => 'required_if:zff_staff,yes',
            'government_employee' => 'required',
            'agency_name' => 'required_if:government_employee,yes',
            'country' => 'required_if:government_employee,yes',
            'consulting_assignment_at_zff' => 'required',
            'found_guilty' => 'required',
            'guiltyDetails' => 'required_if:found_guilty,yes'
        ];
    }
}
