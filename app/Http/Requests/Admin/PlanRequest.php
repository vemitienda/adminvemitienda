<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
            'name' => 'required|max:120',
            'quantity' => 'required|max:1200000',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'El campo nombre es obligatorio',
            'name.max'          => 'El campo nombre no debe contener mas de 120 caracteres',
            'quantity.required' => 'El campo cantidad es obligatorio',
            'quantity.max'      => 'El campo cantidad debe ser menor a 1200000',
        ];
    }
}
