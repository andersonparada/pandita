<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->admin) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre'      => 'required',
            'descripcion' => 'required',
            'precio'      => 'required|min:1',
            'stock'       => 'required',
            'activo'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'      => 'El nombre es requerido',
            'descripcion.required' => 'La descripcion es requerido',
            'stock.required'       => 'El stock es requerido',
            'precio.required'      => 'El precio es requerido',
            'precio.min'           => 'El precio debe ser mayor a 1',
        ];
    }
}
