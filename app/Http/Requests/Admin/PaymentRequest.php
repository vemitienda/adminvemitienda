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
            'user_id' => 'required',
            'plan_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'paid_out' => 'required'
        ];

        // if (!($this->pagado == 0 && $this->pagado == 1)) {
        //     $datos['paid_out'] = 'required';
        // }

        return $datos;
    }

    public function messages()
    {
        return [
            'user_id.required'    => 'Selecciona un usuario',
            'plan_id.required'    => 'Selecciona un plan',
            'start_date.required' => 'Selecciona una fecha de inicio',
            'start_date.date'     => 'Selecciona una fecha válida',
            'end_date.required'   => 'Selecciona una fecha de fin',
            'end_date.date'       => 'Selecciona una fecha válida',
            'paid_out.date'       => 'Selecciona si está pagado o no',
        ];
    }
}
