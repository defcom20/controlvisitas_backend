<?php

namespace App\Http\Requests\Modulo\Visitante;

use Illuminate\Foundation\Http\FormRequest;

class VisitanteUpdateRequest extends FormRequest
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
            'nombre' => ['required', 'string'],
            'dni' => ['required', 'string'],
            'motivo' => ['required', 'string'],
            'lugar' => ['required', 'string'],
            'hora_ing' => ['required', 'string'],
            'hora_sal' => ['required', 'string'],
            'area_id' => ['required', 'integer', 'exists:areas,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'sede_id' => ['required', 'integer', 'exists:sedes,id'],
            'tipo_estado_id' => ['required', 'integer', 'exists:tipo_estados,id'],
        ];
    }
}
