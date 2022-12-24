<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Sede;
use App\Models\TipoEstado;
use App\Models\User;
use App\Models\UserSede;

class UserSedeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserSede::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'sede_id' => Sede::factory(),
            'tipo_estado_id' => TipoEstado::factory(),
        ];
    }
}
