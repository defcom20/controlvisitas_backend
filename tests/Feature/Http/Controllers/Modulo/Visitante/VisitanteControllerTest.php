<?php

namespace Tests\Feature\Http\Controllers\Modulo\Visitante;

use App\Models\Area;
use App\Models\Sede;
use App\Models\TipoEstado;
use App\Models\User;
use App\Models\Visitante;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Modulo\Visitante\VisitanteController
 */
class VisitanteControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $visitantes = Visitante::factory()->count(3)->create();

        $response = $this->get(route('visitante.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Modulo\Visitante\VisitanteController::class,
            'store',
            \App\Http\Requests\Modulo\Visitante\VisitanteStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $nombre = $this->faker->word;
        $dni = $this->faker->word;
        $motivo = $this->faker->word;
        $lugar = $this->faker->word;
        $hora_ing = $this->faker->word;
        $hora_sal = $this->faker->word;
        $area = Area::factory()->create();
        $user = User::factory()->create();
        $sede = Sede::factory()->create();
        $tipo_estado = TipoEstado::factory()->create();

        $response = $this->post(route('visitante.store'), [
            'nombre' => $nombre,
            'dni' => $dni,
            'motivo' => $motivo,
            'lugar' => $lugar,
            'hora_ing' => $hora_ing,
            'hora_sal' => $hora_sal,
            'area_id' => $area->id,
            'user_id' => $user->id,
            'sede_id' => $sede->id,
            'tipo_estado_id' => $tipo_estado->id,
        ]);

        $visitantes = Visitante::query()
            ->where('nombre', $nombre)
            ->where('dni', $dni)
            ->where('motivo', $motivo)
            ->where('lugar', $lugar)
            ->where('hora_ing', $hora_ing)
            ->where('hora_sal', $hora_sal)
            ->where('area_id', $area->id)
            ->where('user_id', $user->id)
            ->where('sede_id', $sede->id)
            ->where('tipo_estado_id', $tipo_estado->id)
            ->get();
        $this->assertCount(1, $visitantes);
        $visitante = $visitantes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $visitante = Visitante::factory()->create();

        $response = $this->get(route('visitante.show', $visitante));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Modulo\Visitante\VisitanteController::class,
            'update',
            \App\Http\Requests\Modulo\Visitante\VisitanteUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $visitante = Visitante::factory()->create();
        $nombre = $this->faker->word;
        $dni = $this->faker->word;
        $motivo = $this->faker->word;
        $lugar = $this->faker->word;
        $hora_ing = $this->faker->word;
        $hora_sal = $this->faker->word;
        $area = Area::factory()->create();
        $user = User::factory()->create();
        $sede = Sede::factory()->create();
        $tipo_estado = TipoEstado::factory()->create();

        $response = $this->put(route('visitante.update', $visitante), [
            'nombre' => $nombre,
            'dni' => $dni,
            'motivo' => $motivo,
            'lugar' => $lugar,
            'hora_ing' => $hora_ing,
            'hora_sal' => $hora_sal,
            'area_id' => $area->id,
            'user_id' => $user->id,
            'sede_id' => $sede->id,
            'tipo_estado_id' => $tipo_estado->id,
        ]);

        $visitante->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($nombre, $visitante->nombre);
        $this->assertEquals($dni, $visitante->dni);
        $this->assertEquals($motivo, $visitante->motivo);
        $this->assertEquals($lugar, $visitante->lugar);
        $this->assertEquals($hora_ing, $visitante->hora_ing);
        $this->assertEquals($hora_sal, $visitante->hora_sal);
        $this->assertEquals($area->id, $visitante->area_id);
        $this->assertEquals($user->id, $visitante->user_id);
        $this->assertEquals($sede->id, $visitante->sede_id);
        $this->assertEquals($tipo_estado->id, $visitante->tipo_estado_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $visitante = Visitante::factory()->create();

        $response = $this->delete(route('visitante.destroy', $visitante));

        $response->assertNoContent();

        $this->assertModelMissing($visitante);
    }
}
