<?php

namespace App\Http\Requests\Modulo\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'uuid' => ['required', 'string', 'max:100', 'unique:users,uuid'],
            'dni' => ['integer'],
            'nombre' => ['string'],
            'apellido' => ['string'],
            'sexo' => ['string'],
            'usuario' => ['required', 'string', 'unique:users,usuario'],
            'password' => ['required', 'password'],
            'password_unico' => ['string'],
            'foto' => ['string'],
            'sede_actual' => ['string'],
            'tipo_role_id' => ['required', 'integer', 'exists:tipo_roles,id'],
            'tipo_estado_id' => ['required', 'integer', 'exists:tipo_estados,id'],
            'email_verified_at' => [''],
            'remember_token' => ['required'],
        ];
    }
}
