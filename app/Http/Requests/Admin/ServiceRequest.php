<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:120',
            'quantity' => 'required|integer|min:-1|max:1000000000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio',
            'name.max'      => 'El campo nombre no debe contener mas de 120 caracteres',
            'name.min'      => 'El campo nombre debe contener mas de 2 caracteres',
            'quantity.required' => 'El campo de cantidad es obligatorio',
            'quantity.max'      => 'El campo cantidad no puede ser mayor a 1.000.000.000',
            'quantity.min'      => 'El campo cantidad debe ser mayor a 0',
        ];
    }
}
