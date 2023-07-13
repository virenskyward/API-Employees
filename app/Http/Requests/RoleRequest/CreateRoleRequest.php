<?php

namespace App\Http\Requests\RoleRequest;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateRoleRequest extends FormRequest
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
            'role_name' => 'required'
        ];

    }

    public function failedValidation(Validator $validator) {
        failedValidation(false, $validator->errors()->first());
    }
}
