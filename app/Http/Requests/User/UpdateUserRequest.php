<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $unique = $this->user_id . ',user_id';

        $validation = [];
        $validation['role_id'] = 'required|exists:roles,role_id';
        $validation['first_name'] = 'required';
        $validation['last_name'] = 'required';
        $validation['email'] = 'required|unique:users,email,' . $unique;
        $validation['phone_no'] = 'required|unique:users,phone_no,' . $unique;
        $validation['gender'] = 'required|in:Male,Female';
        $validation['date_of_birth'] = 'required|date_format:Y-m-d';
        $validation['marital_status'] = 'required|in:UnMarried,Married';
        $validation['pin'] = 'required';
        
        return $validation;

    }

    public function failedValidation(Validator $validator)
    {
        failedValidation(false, $validator->errors()->first());
    }
}