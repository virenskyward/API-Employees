<?php

namespace App\Http\Requests\LeaveRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class FilterLeaveRequest extends FormRequest
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
        $filter = [];
        if (isset($this->date_filter_type) && $this->date_filter_type == 3) {
            $filter = [
                'start_date' => 'required',
                'end_date' => 'required',
            ];
        }
        return $filter;
    }

    public function failedValidation(Validator $validator)
    {
        failedValidation(false, $validator->errors()->first());
    }
}
