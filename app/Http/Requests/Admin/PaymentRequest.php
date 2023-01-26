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
        info("Pagado");
        info($this->pagado);
        $datos = [
            'user_id' => 'required'
        ];

        return $datos;
    }

    public function messages()
    {
        return [
            'user_id.required'    => 'Selecciona un usuario'
        ];
    }
}
