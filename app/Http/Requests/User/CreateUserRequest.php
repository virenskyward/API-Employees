<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateUserRequest extends FormRequest
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
            'role_id' => 'required|exists:roles,role_id',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'phone_no' => 'required|unique:users,phone_no',
            'gender' => 'required|in:Male,Female',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'marital_status' => 'required|in:UnMarried,Married',
            'pin' => 'required',
        ];
        
    }

    public function failedValidation(Validator $validator) {
        failedValidation(false, $validator->errors()->first());
    }
}