<?php

namespace Tests\Feature\Http\Controllers\Maestro;

use App\Models\TipoEstado;
use App\Models\TipoRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Maestro\TipoRoleController
 */
class TipoRoleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $tipoRoles = TipoRole::factory()->count(3)->create();

        $response = $this->get(route('tipo-role.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Maestro\TipoRoleController::class,
            'store',
            \App\Http\Requests\Maestro\TipoRoleStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $nombre = $this->faker->word;
        $tipo_estado = TipoEstado::factory()->create();

        $response = $this->post(route('tipo-role.store'), [
            'nombre' => $nombre,
            'tipo_estado_id' => $tipo_estado->id,
        ]);

        $tipoRoles = TipoRole::query()
            ->where('nombre', $nombre)
            ->where('tipo_estado_id', $tipo_estado->id)
            ->get();
        $this->assertCount(1, $tipoRoles);
        $tipoRole = $tipoRoles->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $tipoRole = TipoRole::factory()->create();

        $response = $this->get(route('tipo-role.show', $tipoRole));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Maestro\TipoRoleController::class,
            'update',
            \App\Http\Requests\Maestro\TipoRoleUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $tipoRole = TipoRole::factory()->create();
        $nombre = $this->faker->word;
        $tipo_estado = TipoEstado::factory()->create();

        $response = $this->put(route('tipo-role.update', $tipoRole), [
            'nombre' => $nombre,
            'tipo_estado_id' => $tipo_estado->id,
        ]);

        $tipoRole->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($nombre, $tipoRole->nombre);
        $this->assertEquals($tipo_estado->id, $tipoRole->tipo_estado_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $tipoRole = TipoRole::factory()->create();

        $response = $this->delete(route('tipo-role.destroy', $tipoRole));

        $response->assertNoContent();

        $this->assertModelMissing($tipoRole);
    }
}
