<?php

namespace App\Http\Requests\Maestro;

use Illuminate\Foundation\Http\FormRequest;

class TipoPermisoUpdateRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'unique:tipo_permisos,nombre'],
            'tipo_estado_id' => ['required', 'integer', 'exists:tipo_estados,id'],
        ];
    }
}
