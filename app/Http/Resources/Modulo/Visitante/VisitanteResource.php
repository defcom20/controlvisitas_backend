<?php

namespace App\Http\Resources\Modulo\Visitante;

use Illuminate\Http\Resources\Json\JsonResource;

class VisitanteResource extends JsonResource
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
            'nombre' => $this->nombre,
            'dni' => $this->dni,
            'motivo' => $this->motivo,
            'lugar' => $this->lugar,
            'hora_ing' => $this->hora_ing,
            'hora_sal' => $this->hora_sal,
            'area_id' => $this->area_id,
            'user_id' => $this->user_id,
            'sede_id' => $this->sede_id,
            'tipo_estado_id' => $this->tipo_estado_id,
            'tipoEstados' => TipoEstadoCollection::make($this->whenLoaded('tipoEstados')),
        ];
    }
}
