<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\TipoEstado;
use App\Models\TipoRole;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'dni' => $this->faker->numberBetween(-10000, 10000),
            'nombre' => $this->faker->word,
            'apellido' => $this->faker->word,
            'sexo' => $this->faker->word,
            'usuario' => $this->faker->word,
            'password' => $this->faker->password,
            'password_unico' => $this->faker->word,
            'foto' => $this->faker->word,
            'sede_actual' => $this->faker->word,
            'tipo_role_id' => TipoRole::factory(),
            'tipo_estado_id' => TipoEstado::factory(),
            'email_verified_at' => $this->faker->dateTime(),
            'remember_token' => Str::random(10),
        ];
    }
}
