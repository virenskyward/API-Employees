<?php

namespace App\Http\Requests\LeaveRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateLeaveRequest extends FormRequest
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
            'employee_id' => 'required',
            'leave_type' => 'required',
            'leave_start_date' => 'required',
            'leave_reason'=> 'required',
            'requested_day' => 'required',
            'leave_day' => 'required',
        ];
        
        if(isset($this->leave_day) && $this->leave_day == 1)
        {
            $leaveRequest['leave_end_date'] = 'required';
        }
        return $leaveRequest;
    }

    public function failedValidation(Validator $validator)
    {
        failedValidation(false, $validator->errors()->first());
    }
}