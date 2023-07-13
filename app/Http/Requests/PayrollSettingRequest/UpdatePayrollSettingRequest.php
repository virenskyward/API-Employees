<?php

namespace App\Http\Requests\PayrollSettingRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePayrollSettingRequest extends FormRequest
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
            'payroll_setting_id' => 'required|exists:payroll_settings,payroll_setting_id',
            'pay_period' => 'required|numeric',
            'pay_day' => 'required|numeric',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        failedValidation(false, $validator->errors()->first());
    }
}
