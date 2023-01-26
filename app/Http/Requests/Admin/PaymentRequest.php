<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
        $datos = [
            'user_id' => 'required',
            'months'  => 'required',
            'payment_method_id' => 'required',
            'reference_number' => 'required',
        ];

        return $datos;
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Selecciona un usuario',
            'months.required'  => 'Selecciona la cantidad de meses a pagar',
            'payment_method_id.required'  => 'Selecciona el método de pago',
            'reference_number.required'  => 'Ingrese el nro de referencia',
        ];
    }
}
