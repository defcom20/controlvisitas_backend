<?php

namespace App\Http\Resources\Modulo\Usuario;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'dni' => $this->dni,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'sexo' => $this->sexo,
            'usuario' => $this->usuario,
            'password_unico' => $this->password_unico,
            'foto' => $this->foto,
            'sede_actual' => $this->sede_actual,
            'tipo_role_id' => $this->tipo_role_id,
            'tipo_estado_id' => $this->tipo_estado_id,
            'email_verified_at' => $this->email_verified_at,
            'tipoEstados' => TipoEstadoCollection::make($this->whenLoaded('tipoEstados')),
        ];
    }
}
