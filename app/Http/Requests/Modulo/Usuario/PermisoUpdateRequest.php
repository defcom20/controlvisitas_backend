<?php

namespace App\Http\Requests\Modulo\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class PermisoUpdateRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'user_sede_id' => ['required', 'integer', 'exists:user_sedes,id'],
            'habilidades' => ['required', 'json'],
        ];
    }
}
