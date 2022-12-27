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
            'area_id' => ['required', 'integer', 'exists:areas,id']
        ];
    }
}
