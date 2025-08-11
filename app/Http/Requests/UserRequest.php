<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del usuario es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'email.required' => 'El correo del usuario es obligatorio.',
            'email.email' => 'El correo debe ser un correo valido.',
            'email.unique' => 'El correo ya esta en uso.',
            'password.required' => 'La contraseña del usuario es obligatorio.',
            'password.min' => 'La contraseña debe tener 6 caracteres minimo.',
        ];
    }
}
