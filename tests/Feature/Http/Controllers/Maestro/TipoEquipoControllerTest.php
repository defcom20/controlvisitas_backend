<?php

namespace Tests\Feature\Http\Controllers\Maestro;

use App\Models\TipoEquipo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Maestro\TipoEquipoController
 */
class TipoEquipoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $tipoEquipos = TipoEquipo::factory()->count(3)->create();

        $response = $this->get(route('tipo-equipo.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Maestro\TipoEquipoController::class,
            'store',
            \App\Http\Requests\Maestro\TipoEquipoStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $response = $this->post(route('tipo-equipo.store'));

        $response->assertCreated();
        $response->assertJsonStructure([]);

        $this->assertDatabaseHas(tipoEquipos, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $tipoEquipo = TipoEquipo::factory()->create();

        $response = $this->get(route('tipo-equipo.show', $tipoEquipo));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Maestro\TipoEquipoController::class,
            'update',
            \App\Http\Requests\Maestro\TipoEquipoUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $tipoEquipo = TipoEquipo::factory()->create();

        $response = $this->put(route('tipo-equipo.update', $tipoEquipo));

        $tipoEquipo->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $tipoEquipo = TipoEquipo::factory()->create();

        $response = $this->delete(route('tipo-equipo.destroy', $tipoEquipo));

        $response->assertNoContent();

        $this->assertModelMissing($tipoEquipo);
    }
}
