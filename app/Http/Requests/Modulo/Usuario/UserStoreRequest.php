<?php

namespace App\Http\Requests\Modulo\Usuario;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
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
            'nombre' => ['string'],
            'usuario' => ['required', 'string', 'unique:users'],
            'password' => ['required', Password::min(6)],
            'tipo_role_id' => ['required', 'integer', 'exists:tipo_roles,id'],
            'tipo_estado_id' => ['required', 'integer', 'exists:tipo_estados,id']
        ];
    }
}
