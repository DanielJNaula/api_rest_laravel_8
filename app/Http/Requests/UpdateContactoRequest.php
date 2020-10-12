<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactoRequest extends FormRequest
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
            'nombre'   => 'required|min:5|max:100',
            'telefono' => 'required|unique:contactos,telefono,' . $this->route('contacto')->id,
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'   => 'El nombre es requerido',
            'nombre.min'        => 'El nombre debe tener mas de 5 caracteres',
            'nombre.max'        => 'El nombre debe tener hasta 100 caracteres',
            'telefono.required' => 'El telefono del contacto es requerido',
            'telefono.unique'   => 'El telefono del contacto debe ser unico',
        ];
    }
}
