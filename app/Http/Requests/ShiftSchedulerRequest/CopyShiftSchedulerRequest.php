<?php

namespace App\Http\Requests\ShiftSchedulerRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CopyShiftSchedulerRequest extends FormRequest
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
            'btn_date' => 'required'
        ];
    }

    public function failedValidation(Validator $validator) {
        failedValidation(false, $validator->errors()->first());
    }
}