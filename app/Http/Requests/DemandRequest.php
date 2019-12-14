<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'sold_units' => 'required|numeric|max:100',
                    'number_days' => 'required|numeric|max:100',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'sold_units' => 'required|numeric|max:100',
                    'number_days' => 'required|numeric|max:100',
                ];
            }
            default:
                break;
        }

        return [
            //
        ];
    }

    public function messages()
    {
        return [
            'sold_units.required' => 'El campo :attribute es obligatorio.',
            'sold_units.numeric' => 'El campo :attribute solo puede contener numeros.',
            'sold_units.max' => 'El campo :attribute no debe ser mayor a 100 caracteres.',
            
            'number_days.required' => 'El campo :attribute es obligatorio.',
            'number_days.numeric' => 'El campo :attribute solo puede contener numeros.',
            'number_days.max' => 'El campo :attribute no debe ser mayor a 100 caracteres.',
        ];
    }

    public function attributes()
    {
        return [
            'sold_units' => 'Unidades Vendidas',
            'number_days' => 'Numero de dias',
        ];
    }
}
