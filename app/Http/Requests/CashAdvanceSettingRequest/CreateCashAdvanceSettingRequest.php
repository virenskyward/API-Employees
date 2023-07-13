<?php

namespace App\Http\Requests\CashAdvanceSettingRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateCashAdvanceSettingRequest extends FormRequest
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
            'cash_advance_amount' => 'required|numeric',
            'cash_advance_percentage' => 'required|numeric',
            'cash_advance_no_of_paychecks' => 'required|numeric',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        failedValidation(false, $validator->errors()->first());
    }
}
