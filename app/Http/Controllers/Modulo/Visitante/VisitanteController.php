<?php

namespace App\Http\Controllers\Modulo\Visitante;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modulo\Visitante\VisitanteStoreRequest;
use App\Http\Requests\Modulo\Visitante\VisitanteUpdateRequest;
use App\Http\Resources\Modulo\Visitante\VisitanteCollection;
use App\Http\Resources\Modulo\Visitante\VisitanteResource;
use App\Models\UserSede;
use App\Models\Visitante;
use App\Traits\HttpResponses;
use App\Traits\ValidatePermiso;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VisitanteController extends Controller
{

    use HttpResponses, ValidatePermiso;

    protected $visit;

    public function __construct(Visitante $visit)
    {
        $this->visit = $visit;
    }

    public function index()
    {
        return response()->json([
            'collection' => $this->visit->where('sede_id', 1)->with('Area', 'User:id,nombre', 'TipoEstado:id,nombre')->advancedFilter()
        ]);
    }

    public function store(VisitanteStoreRequest $request)
    {
        $mytime = Carbon::now();
        $sedeId = UserSede::where("user_id", auth()->user()->id)->first();
        $res = $this->visit->create([
            "nombre" => $request['nombre'],
            "dni" => $request['dni'],
            "motivo" => $request['motivo'],
            "lugar" => $request['lugar'],
            "hora_ing" => $mytime->toDateTimeString(),
            "hora_sal" => "",
            "area_id" => $request['area_id'],
            "user_id" => auth()->user()->id,
            "sede_id" => $sedeId->sede_id,
            "tipo_estado_id" => 5
        ]);

        return $this->successResponse($res, 'Visitante');
    }

    public function marcar($id){
        DB::beginTransaction();
        try {
            $response = $this->visit->find($id);
            if (!$response) return $this->errorResponse($id);

            $carbon = Carbon::now();
            $response->update([
                "hora_sal" => $carbon,
                "tipo_estado_id" => 6
            ]);

            DB::commit();
            return $this->successResponse($response, 'Update');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse('', $e);
        }
    }

    public function show($id)
    {
        DB::beginTransaction();
        try {
            $response = $this->visit->find($id);
            if (!$response) return $this->errorResponse($id);

            $response = $this->visit->where("id", $id)->with('Area', 'User:id,nombre', 'TipoEstado:id,nombre')->first();

            DB::commit();
            return $this->successResponse($response, 'Update');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse('', $e);
        }
    }

    public function update(VisitanteUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $response = $this->visit->find($id);
            if (!$response) return $this->errorResponse($id);
            $response->update([
                "nombre" => $request['nombre'],
                "dni" => $request['dni'],
                "motivo" => $request['motivo'],
                "lugar" => $request['lugar'],
                "area_id" => $request['area_id']
            ]);
            DB::commit();
            return $this->successResponse($response, 'Update');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse('', $e);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // $res = $this->isAuthorization(auth()->user()->id);
            // if (!$res) return $this->errorResponse('', 'Acceso denegado, No tiene permiso.');
            $response = $this->visit->find($id);
            if (!$response) return $this->errorResponse($id);
            $response->delete();
            DB::commit();
            return $this->successResponse($response, 'Delete');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse('', $e->errorInfo[2]);
        }
    }
}
