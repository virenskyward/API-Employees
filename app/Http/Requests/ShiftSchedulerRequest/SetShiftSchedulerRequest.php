<?php

namespace App\Http\Requests\ShiftSchedulerRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class SetShiftSchedulerRequest extends FormRequest
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
            'employee_id' => 'required',
            'shift_date' => 'required',
            'shift_start_time' => 'required',
            'shift_end_time' => 'required',
        ];
    }

    public function failedValidation(Validator $validator) {
        failedValidation(false, $validator->errors()->first());
    }
}