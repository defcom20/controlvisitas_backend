<?php

namespace App\Models;

use App\Support\DataviewerClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, DataviewerClient;

    protected $allowedFilters = [
        'id', 'uuid', 'dni', 'nombre', 'apellido', 'sexo', 'usuario', 'password', 'password_unico', 'foto', 'sede_actual', 'tipo_role_id', 'tipo_estado_id', 'email_verified_at', 'remember_token', 'created_at', 'updated_at'
    ];

    protected $orderable = [
        'id', 'uuid', 'dni', 'nombre', 'apellido', 'sexo', 'usuario', 'password', 'password_unico', 'foto', 'sede_actual', 'tipo_role_id', 'tipo_estado_id', 'email_verified_at', 'remember_token', 'created_at', 'updated_at'
    ];

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
    public function userSede()
    {
        return $this->hasOne(UserSede::class);
    }
}
