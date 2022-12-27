<?php

namespace App\Http\Controllers\Modulo\Usuario;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Modulo\Usuario\UserResource;
use App\Http\Requests\Modulo\Usuario\UserStoreRequest;
use App\Models\Permiso;
use App\Models\UserSede;
use App\Traits\HttpResponses;
use App\Traits\ValidatePermiso;
use Illuminate\Support\Str;

class UserController extends Controller
{

    use HttpResponses, ValidatePermiso;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return response()->json([
            'collection' => $this->user->with(['TipoRole:id,nombre', 'tipoEstado:id,nombre', 'UserSede' => function ($query) {
                $query->with('sede')->select("id", "user_id", "sede_id");
            }])
            ->select('id', 'nombre', 'usuario', 'tipo_role_id', 'tipo_estado_id')->advancedFilter()
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        $request->validated($request->all());

        DB::beginTransaction();
        try {

            $data = $request->all();
            $data['uuid'] = Str::uuid()->toString();
            $data['password'] = bcrypt($request->password);

            // REGISTRAR USUARIO
            $user = $this->user->create([
                "uuid" => $data['uuid'],
                "nombre" => $data['nombre'],
                "usuario" => $data['usuario'],
                "password" => $data['password'],
                "tipo_role_id" => $data['tipo_role_id'],
                "tipo_estado_id" => $data['tipo_estado_id']
            ]);
            //REGISTRAR USER_SEDE
            $resSede = UserSede::create([
                "user_id" => $user->id,
                "sede_id" => $data['sede_id'],
                "tipo_estado_id" => 1,
            ]);

            Permiso::create([
                "user_id" => $user->id,
                "user_sede_id" => $resSede->id,
                "habilidades" => ["SHOW", "CREATE", "EDIT", "DELETE"],
            ]);


            DB::commit();
            return $this->successResponse($user, 'Register exitoso.');
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
            //return $this->errorResponse('', $e);
        }

        // $user = User::create($request->validated());

        // return new UserResource($user);
    }

    public function show($id)
    {
        DB::beginTransaction();
        try {
            $response = $this->user->find($id);
            if (!$response) return $this->errorResponse($id);

            $response = $this->user->where("id", $id)->with(['TipoRole:id,nombre', 'tipoEstado:id,nombre', 'UserSede' => function ($query) {
                $query->with('sede')->select("id", "user_id", "sede_id");
            }])->first();

            DB::commit();
            return $this->successResponse($response, 'Update');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse('', $e);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            // $res = $this->isAuthorization(auth()->user()->id);
            // if (!$res) return $this->errorResponse('', 'Acceso denegado, No tiene permiso.');

            $response = $this->user->find($id);
            if (!$response) return $this->errorResponse($id);

            $data = $request->all();
            $data['password'] = $request->password ? bcrypt($request->password) : "";
            // UPDATE USUARIO
            $response->update([
                "nombre" => $request['nombre'],
                "usuario" => $request['usuario'],
                "password" => $request['password'] ? $request['password'] : $response->password,
                "tipo_role_id" => $request['tipo_role_id'],
                "tipo_estado_id" => $request['tipo_estado_id']
            ]);
            //UPDATE USER_SEDE
            // Permiso::where("user_id", auth()->user()->id)->update([
            //     "habilidades" => $request['habilidades']
            // ]);

            DB::commit();
            return $this->successResponse($response, 'Update');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse('', $e->errorInfo[2]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            // $res = $this->isAuthorization(auth()->user()->id);
            // if (!$res) return $this->errorResponse('', 'Acceso denegado, No tiene permiso.');
            $response = $this->user->find($id);
            if (!$response) return $this->errorResponse($id);
            $response->update(["tipo_estado_id" => 2]);
            DB::commit();
            return $this->successResponse($response, 'Delete');
        }catch(\Exception $e){
            DB::rollback();
            return $this->errorResponse('', $e->errorInfo[2]);
        }
    }
}
