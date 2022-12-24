<?php

namespace Tests\Feature\Http\Controllers\Maestro;

use App\Models\Area;
use App\Models\TipoEstado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Maestro\AreaController
 */
class AreaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $areas = Area::factory()->count(3)->create();

        $response = $this->get(route('area.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Maestro\AreaController::class,
            'store',
            \App\Http\Requests\Maestro\AreaStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $nombre = $this->faker->word;
        $tipo_estado = TipoEstado::factory()->create();

        $response = $this->post(route('area.store'), [
            'nombre' => $nombre,
            'tipo_estado_id' => $tipo_estado->id,
        ]);

        $areas = Area::query()
            ->where('nombre', $nombre)
            ->where('tipo_estado_id', $tipo_estado->id)
            ->get();
        $this->assertCount(1, $areas);
        $area = $areas->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $area = Area::factory()->create();

        $response = $this->get(route('area.show', $area));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Maestro\AreaController::class,
            'update',
            \App\Http\Requests\Maestro\AreaUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $area = Area::factory()->create();
        $nombre = $this->faker->word;
        $tipo_estado = TipoEstado::factory()->create();

        $response = $this->put(route('area.update', $area), [
            'nombre' => $nombre,
            'tipo_estado_id' => $tipo_estado->id,
        ]);

        $area->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($nombre, $area->nombre);
        $this->assertEquals($tipo_estado->id, $area->tipo_estado_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $area = Area::factory()->create();

        $response = $this->delete(route('area.destroy', $area));

        $response->assertNoContent();

        $this->assertModelMissing($area);
    }
}
