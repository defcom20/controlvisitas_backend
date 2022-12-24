<?php

namespace Tests\Feature\Http\Controllers\Maestro;

use App\Models\TipoEstado;
use App\Models\TipoPermiso;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Maestro\TipoPermisoController
 */
class TipoPermisoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $tipoPermisos = TipoPermiso::factory()->count(3)->create();

        $response = $this->get(route('tipo-permiso.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Maestro\TipoPermisoController::class,
            'store',
            \App\Http\Requests\Maestro\TipoPermisoStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $nombre = $this->faker->word;
        $tipo_estado = TipoEstado::factory()->create();

        $response = $this->post(route('tipo-permiso.store'), [
            'nombre' => $nombre,
            'tipo_estado_id' => $tipo_estado->id,
        ]);

        $tipoPermisos = TipoPermiso::query()
            ->where('nombre', $nombre)
            ->where('tipo_estado_id', $tipo_estado->id)
            ->get();
        $this->assertCount(1, $tipoPermisos);
        $tipoPermiso = $tipoPermisos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $tipoPermiso = TipoPermiso::factory()->create();

        $response = $this->get(route('tipo-permiso.show', $tipoPermiso));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Maestro\TipoPermisoController::class,
            'update',
            \App\Http\Requests\Maestro\TipoPermisoUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $tipoPermiso = TipoPermiso::factory()->create();
        $nombre = $this->faker->word;
        $tipo_estado = TipoEstado::factory()->create();

        $response = $this->put(route('tipo-permiso.update', $tipoPermiso), [
            'nombre' => $nombre,
            'tipo_estado_id' => $tipo_estado->id,
        ]);

        $tipoPermiso->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($nombre, $tipoPermiso->nombre);
        $this->assertEquals($tipo_estado->id, $tipoPermiso->tipo_estado_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $tipoPermiso = TipoPermiso::factory()->create();

        $response = $this->delete(route('tipo-permiso.destroy', $tipoPermiso));

        $response->assertNoContent();

        $this->assertModelMissing($tipoPermiso);
    }
}
