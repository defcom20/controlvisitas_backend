<?php

namespace App\Models;

use App\Support\DataviewerClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    use HasFactory, DataviewerClient;


    protected $allowedFilters = [
        'id', 'nombre', 'dni', 'motivo', 'lugar', 'hora_ing', 'hora_sal', 'area_id', 'user_id', 'sede_id', 'tipo_estado_id', 'created_at', 'updated_at'
    ];

    protected $orderable = [
        'id', 'nombre', 'dni', 'motivo', 'lugar', 'hora_ing', 'hora_sal', 'area_id', 'user_id', 'sede_id', 'tipo_estado_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'area_id' => 'integer',
        'user_id' => 'integer',
        'sede_id' => 'integer',
        'tipo_estado_id' => 'integer',
    ];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function sedes()
    {
        return $this->hasMany(Sede::class);
    }

    public function tipoEstados()
    {
        return $this->hasMany(TipoEstado::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }

    public function tipoEstado()
    {
        return $this->belongsTo(TipoEstado::class);
    }
}
