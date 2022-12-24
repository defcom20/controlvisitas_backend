<?php

namespace Tests\Feature\Http\Controllers\Modulo\Usuario;

use App\Models\TipoEstado;
use App\Models\TipoRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Modulo\Usuario\UserController
 */
class UserControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $users = User::factory()->count(3)->create();

        $response = $this->get(route('user.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Modulo\Usuario\UserController::class,
            'store',
            \App\Http\Requests\Modulo\Usuario\UserStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $uuid = $this->faker->uuid;
        $usuario = $this->faker->word;
        $password = $this->faker->password;
        $tipo_role = TipoRole::factory()->create();
        $tipo_estado = TipoEstado::factory()->create();
        $remember_token = $this->faker->;

        $response = $this->post(route('user.store'), [
            'uuid' => $uuid,
            'usuario' => $usuario,
            'password' => $password,
            'tipo_role_id' => $tipo_role->id,
            'tipo_estado_id' => $tipo_estado->id,
            'remember_token' => $remember_token,
        ]);

        $users = User::query()
            ->where('uuid', $uuid)
            ->where('usuario', $usuario)
            ->where('password', $password)
            ->where('tipo_role_id', $tipo_role->id)
            ->where('tipo_estado_id', $tipo_estado->id)
            ->where('remember_token', $remember_token)
            ->get();
        $this->assertCount(1, $users);
        $user = $users->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $user = User::factory()->create();

        $response = $this->get(route('user.show', $user));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Modulo\Usuario\UserController::class,
            'update',
            \App\Http\Requests\Modulo\Usuario\UserUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $user = User::factory()->create();
        $uuid = $this->faker->uuid;
        $usuario = $this->faker->word;
        $password = $this->faker->password;
        $tipo_role = TipoRole::factory()->create();
        $tipo_estado = TipoEstado::factory()->create();
        $remember_token = $this->faker->;

        $response = $this->put(route('user.update', $user), [
            'uuid' => $uuid,
            'usuario' => $usuario,
            'password' => $password,
            'tipo_role_id' => $tipo_role->id,
            'tipo_estado_id' => $tipo_estado->id,
            'remember_token' => $remember_token,
        ]);

        $user->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($uuid, $user->uuid);
        $this->assertEquals($usuario, $user->usuario);
        $this->assertEquals($password, $user->password);
        $this->assertEquals($tipo_role->id, $user->tipo_role_id);
        $this->assertEquals($tipo_estado->id, $user->tipo_estado_id);
        $this->assertEquals($remember_token, $user->remember_token);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $user = User::factory()->create();

        $response = $this->delete(route('user.destroy', $user));

        $response->assertNoContent();

        $this->assertModelMissing($user);
    }
}
