<?php

namespace Tests\Feature\Http\Controllers\Modulo\Usuario;

use App\Models\Permiso;
use App\Models\User;
use App\Models\UserSede;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Modulo\Usuario\PermisoController
 */
class PermisoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $permisos = Permiso::factory()->count(3)->create();

        $response = $this->get(route('permiso.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Modulo\Usuario\PermisoController::class,
            'store',
            \App\Http\Requests\Modulo\Usuario\PermisoStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $user = User::factory()->create();
        $user_sede = UserSede::factory()->create();
        $habilidades = $this->faker->;

        $response = $this->post(route('permiso.store'), [
            'user_id' => $user->id,
            'user_sede_id' => $user_sede->id,
            'habilidades' => $habilidades,
        ]);

        $permisos = Permiso::query()
            ->where('user_id', $user->id)
            ->where('user_sede_id', $user_sede->id)
            ->where('habilidades', $habilidades)
            ->get();
        $this->assertCount(1, $permisos);
        $permiso = $permisos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $permiso = Permiso::factory()->create();

        $response = $this->get(route('permiso.show', $permiso));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Modulo\Usuario\PermisoController::class,
            'update',
            \App\Http\Requests\Modulo\Usuario\PermisoUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $permiso = Permiso::factory()->create();
        $user = User::factory()->create();
        $user_sede = UserSede::factory()->create();
        $habilidades = $this->faker->;

        $response = $this->put(route('permiso.update', $permiso), [
            'user_id' => $user->id,
            'user_sede_id' => $user_sede->id,
            'habilidades' => $habilidades,
        ]);

        $permiso->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user->id, $permiso->user_id);
        $this->assertEquals($user_sede->id, $permiso->user_sede_id);
        $this->assertEquals($habilidades, $permiso->habilidades);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $permiso = Permiso::factory()->create();

        $response = $this->delete(route('permiso.destroy', $permiso));

        $response->assertNoContent();

        $this->assertModelMissing($permiso);
    }
}
