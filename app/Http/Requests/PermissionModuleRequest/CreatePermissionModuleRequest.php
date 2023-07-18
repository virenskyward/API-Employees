<?php

namespace App\Http\Requests\PermissionModuleRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreatePermissionModuleRequest extends FormRequest
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
            'permission_module_name' => 'required',
            'permission_module_status' => 'required',
        ];

    }

    public function failedValidation(Validator $validator)
    {
        failedValidation(false, $validator->errors()->first());
    }
}
