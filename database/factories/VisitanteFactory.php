<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Area;
use App\Models\Sede;
use App\Models\TipoEstado;
use App\Models\User;
use App\Models\Visitante;

class VisitanteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visitante::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'dni' => $this->faker->word,
            'motivo' => $this->faker->word,
            'lugar' => $this->faker->word,
            'hora_ing' => $this->faker->word,
            'hora_sal' => $this->faker->word,
            'area_id' => Area::factory(),
            'user_id' => User::factory(),
            'sede_id' => Sede::factory(),
            'tipo_estado_id' => TipoEstado::factory(),
        ];
    }
}
