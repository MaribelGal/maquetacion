<?php

/*
|--------------------------------------------------------------------------
| Validaciones del formulario de la sección FAQ's
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

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules() 
    {
        return [
            'name' => 'required|min:3|max:64|regex:/^[a-z0-9áéíóúàèìòùäëïöüñ\s]+$/i',
            'email' => ['required','email', 'max:255', Rule::unique('users')->ignore($this->id)],
            'password' => 'required_with:password_confirmation|confirmed|required_without:id',
            'password_confirmation' => ''

            //Alternativa al confirmed:
            // 'password' => 'required_without:id',
            // 'password_confirmation' => 'required_without:id|same:password'
        ];
    }

    public function messages()
    {
        return [
            // En lang /es /va
        ];
    }
}
