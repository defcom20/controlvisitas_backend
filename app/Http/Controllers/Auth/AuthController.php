<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginStoreRequest;
use Illuminate\Support\Facades\Auth;
use App\Traits\HttpResponses;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginStoreRequest $request)
    {
        $request->validated($request->all());
        if (Auth::attempt(['usuario' => $request->usuario, 'password' => $request->password, 'tipo_estado_id' => 1])) {

            $user = User::with('TipoRole:id,nombre', 'tipoEstado:id,nombre')->select('id', 'uuid', 'usuario', 'tipo_role_id', 'tipo_estado_id')->where('usuario', $request->usuario)->first();

            $res = [
                'user' => $user,
                'token' => $user->createToken('token' . $user->nombre)->plainTextToken
            ];

            return $this->successResponse($res, 'Login exitoso.');
        }
        return response([
            'message' => ['Estas credenciales no coinciden con nuestros registros.']
        ], 404);
    }
}
