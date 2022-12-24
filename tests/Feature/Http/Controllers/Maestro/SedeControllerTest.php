<?php

namespace Tests\Feature\Http\Controllers\Maestro;

use App\Models\Sede;
use App\Models\TipoEstado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Maestro\SedeController
 */
class SedeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $sedes = Sede::factory()->count(3)->create();

        $response = $this->get(route('sede.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Maestro\SedeController::class,
            'store',
            \App\Http\Requests\Maestro\SedeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $nombre = $this->faker->word;
        $tipo_estado = TipoEstado::factory()->create();

        $response = $this->post(route('sede.store'), [
            'nombre' => $nombre,
            'tipo_estado_id' => $tipo_estado->id,
        ]);

        $sedes = Sede::query()
            ->where('nombre', $nombre)
            ->where('tipo_estado_id', $tipo_estado->id)
            ->get();
        $this->assertCount(1, $sedes);
        $sede = $sedes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $sede = Sede::factory()->create();

        $response = $this->get(route('sede.show', $sede));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Maestro\SedeController::class,
            'update',
            \App\Http\Requests\Maestro\SedeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $sede = Sede::factory()->create();
        $nombre = $this->faker->word;
        $tipo_estado = TipoEstado::factory()->create();

        $response = $this->put(route('sede.update', $sede), [
            'nombre' => $nombre,
            'tipo_estado_id' => $tipo_estado->id,
        ]);

        $sede->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($nombre, $sede->nombre);
        $this->assertEquals($tipo_estado->id, $sede->tipo_estado_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $sede = Sede::factory()->create();

        $response = $this->delete(route('sede.destroy', $sede));

        $response->assertNoContent();

        $this->assertModelMissing($sede);
    }
}
