<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
                    'sales_price' => 'required|numeric|max:100',
                    'number_days' => 'required|numeric|max:100',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'sales_price' => 'required|numeric|max:100',
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
            'sales_price.required' => 'El campo :attribute es obligatorio.',
            'sales_price.numeric' => 'El campo :attribute solo puede contener numeros.',
            'sales_price.max' => 'El campo :attribute no debe ser mayor a 100 caracteres.',
            
            'number_days.required' => 'El campo :attribute es obligatorio.',
            'number_days.numeric' => 'El campo :attribute solo puede contener numeros.',
            'number_days.max' => 'El campo :attribute no debe ser mayor a 100 caracteres.',
        ];
    }

    public function attributes()
    {
        return [
            'sales_price' => 'Precio de venta',
            'number_days' => 'Numero de dias',
        ];
    }
}
