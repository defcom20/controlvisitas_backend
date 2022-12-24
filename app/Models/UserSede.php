<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSede extends Model
{
    use HasFactory;

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
        'user_id' => 'integer',
        'sede_id' => 'integer',
        'tipo_estado_id' => 'integer',
    ];

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
