<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacturaStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'articulos'            => 'required|min:1',
            'articulos.*.cantidad' => 'required|min:1',
            'direccion'            => 'required',
        ];
    }

    public function messages()
    {
        return [
            'articulos.required' => 'Los articulos son requeridos, al menos 1',
            'articulos.min'      => 'Los articulos son requeridos, al menos 1',
            'direccion.required'  => 'La direccion es requerida',
        ];
    }
}
