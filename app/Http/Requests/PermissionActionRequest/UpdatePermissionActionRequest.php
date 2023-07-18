<?php

namespace App\Http\Requests\PermissionActionRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionActionRequest extends FormRequest
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
            'permission_action_id' => 'required|exists:permission_actions,permission_action_id',
            'permission_module_id' => 'required|exists:permission_modules,permission_module_id',
            'permission_action_name' => 'required',
            'permission_action_status' => 'required',
        ];

    }

    public function failedValidation(Validator $validator)
    {
        failedValidation(false, $validator->errors()->first());
    }
}
