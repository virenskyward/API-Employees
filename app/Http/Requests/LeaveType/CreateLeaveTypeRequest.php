<?php

namespace App\Http\Requests\LeaveType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateLeaveTypeRequest extends FormRequest
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
        return [
            'leave_type_uuid' => 'required|string|max:10',
            'leave_type' => 'required|string|max:100',
            'max_leave' => 'required',
            'leave_interval' => 'required|string|max:100',
            'leave_type_status' => 'required',
            'created_from' => 'required',
        ];
    }
    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'error'   => $validator->errors()->first()
        ]));
    }
}
