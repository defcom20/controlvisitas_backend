<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tipo_role_id' => 'integer',
        'tipo_estado_id' => 'integer',
        'email_verified_at' => 'timestamp',
    ];

    public function tipoRoles()
    {
        return $this->hasMany(TipoRole::class);
    }

    public function tipoEstados()
    {
        return $this->hasMany(TipoEstado::class);
    }

    public function tipoRole()
    {
        return $this->belongsTo(TipoRole::class);
    }

    public function tipoEstado()
    {
        return $this->belongsTo(TipoEstado::class);
    }
}
