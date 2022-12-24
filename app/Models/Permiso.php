<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
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
        'user_sede_id' => 'integer',
        'habilidades' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userSede()
    {
        return $this->belongsTo(UserSede::class);
    }
}
