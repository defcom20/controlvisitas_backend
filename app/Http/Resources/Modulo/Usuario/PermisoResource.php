<?php

namespace App\Http\Resources\Modulo\Usuario;

use Illuminate\Http\Resources\Json\JsonResource;

class PermisoResource extends JsonResource
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
            'user_id' => $this->user_id,
            'user_sede_id' => $this->user_sede_id,
            'habilidades' => $this->habilidades,
        ];
    }
}
