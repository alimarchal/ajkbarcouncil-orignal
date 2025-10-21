<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdvocateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $advocateId = $this->route('advocate')?->id;

        return [
            'bar_association_id' => 'required|uuid|exists:bar_associations,id',
            'name' => 'required|string|max:255',
            'father_husband_name' => 'required|string|max:255',
            'complete_address' => 'required|string',
            'visitor_member_of_bar_association' => 'nullable|string|max:255',
            'date_of_enrolment_lower_courts' => 'nullable|date',
            'date_of_enrolment_high_court' => 'nullable|date',
            'date_of_enrolment_supreme_court' => 'nullable|date',
            'voter_member_of_bar_association' => 'nullable|string|max:255',
            'duration_of_practice' => 'nullable|date',
            'mobile_no' => 'required|string|max:20',
            'email_address' => "required|email|unique:advocates,email_address,{$advocateId},id",
            'is_active' => 'required|boolean',
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'bar_association_id.required' => 'Bar Association is required',
            'bar_association_id.exists' => 'Selected Bar Association does not exist',
            'name.required' => 'Advocate name is required',
            'father_husband_name.required' => 'Father/Husband name is required',
            'complete_address.required' => 'Complete address is required',
            'mobile_no.required' => 'Mobile number is required',
            'email_address.required' => 'Email address is required',
            'email_address.unique' => 'This email address is already registered',
            'is_active.required' => 'Status is required',
        ];
    }
}
