<?php

namespace App\Http\Requests\LeaveRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaveRequest extends FormRequest
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
        $leaveRequest = [
            'leave_request_uid' => 'required',
            'leave_type' => 'required',
            'employee_id' => 'required',
            'leave_status' => 'required',
        ];

        if (isset($this->leave_status) && $this->leave_status == 2) {
            $leaveRequest['deny_reason'] = 'required';
        }
        return $leaveRequest;
    }

    public function failedValidation(Validator $validator)
    {
        failedValidation(false, $validator->errors()->first());
    }
}