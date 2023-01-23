<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PlanUserRequest extends FormRequest
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
            'user_id' => 'required',
            'plan_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Debe seleccionar un usuario',
            'plan_id.required' => 'Debe seleccionar un plan',
        ];
    }
}
