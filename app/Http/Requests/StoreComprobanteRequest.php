<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComprobanteRequest extends FormRequest
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
            //
            'clave' => ['required'],
            'consecutivo' => ['required'],
            'estado' => ['required'],
            'cedula' => ['required'],
            'nombre' => ['required'],
            'url_carpeta' => ['required'],
            'url_firmado' => ['required'],
            'url_respuesta' => ['required'],
            'url_pdf' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'clave.required' => 'La clave es necesaria.',
            'consecutivo.required' => 'El consecutivo es necesaria.',
            'estado.required' => 'El estado es necesario.'
        ];
    }
}
