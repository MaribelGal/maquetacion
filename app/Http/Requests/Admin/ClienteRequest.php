<?php

/*
|--------------------------------------------------------------------------
| Validaciones del formulario de la sección Clientes
|--------------------------------------------------------------------------
|
| **authorize: determina si el usuario debe estar autorizado para enviar el formulario. 
|
| **rules: recoge las normas que se deben cumplir para validar el formulario. Los errores son 
|   devueltos en forma de objeto JSON en un error 422.
| 
| **messages: mensajes personalizados de error.
|    
*/

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClienteRequest extends FormRequest
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

    public function rules()
    {
        return [
            'nombre' => 'required|min:3|max:64|regex:/^[a-z0-9áéíóúàèìòùäëïöüñ\s]+$/i',
            'nif' => ['required', 'size:9', Rule::unique('clientes')->ignore($this->id)],

            //"Recomendacion internacional: el número completo debe constar de 
            // un máximo de 15 dígitos y comenzar por un prefijo nacional."
            'telefono' => 'required|min:9|max:15',
            'correo' => 'required|email|max:255',
            'direccion' => 'required|min:3|max:255|regex:/^[a-z0-9áéíóúàèìòùäëïöüñ\s]+$/i',
            'poblacion' => 'required|min:3|max:64|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'provincia' => 'required|min:3|max:64|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'provincia' => 'required|min:3|max:64|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
            'cp' => 'required|size:5',
            'nif' => 'required|size:9',

            //La expresion regular del nif no consigo que funcione ([a-z]|[A-Z]|[0-9])[0-9]{7}([a-z]|[A-Z]|[0-9])
        ];
    }
}
