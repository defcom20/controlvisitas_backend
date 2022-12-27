<?php

namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Maestro\SedeStoreRequest;
use App\Http\Requests\Maestro\SedeUpdateRequest;
use App\Http\Resources\Maestro\SedeCollection;
use App\Http\Resources\Maestro\SedeResource;
use App\Models\Sede;
use App\Models\TipoEstado;
use App\Models\TipoRole;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class SedeController extends Controller
{
    use HttpResponses;

    protected $sede;
    protected $estado;
    protected $tipo_role;

    public function __construct(Sede $sede, TipoRole $tipo_role, TipoEstado $estado)
    {
        $this->sede = $sede;
        $this->estado = $estado;
        $this->tipo_role = $tipo_role;
    }

    public function index()
    {
        $sede = $this->sede->get();
        $estado = $this->estado->where("switch", "CRUD")->get();
        $tipo_role = $this->tipo_role->get();
        //$estado = $this->estado->get();

        $data = [
            "sede" => $sede,
            "estado" => $estado,
            "rol" => $tipo_role,
        ];

        return $this->successResponse($data, 'Show sede.');
    }

    /**
     * @param \App\Http\Requests\Maestro\SedeStoreRequest $request
     * @return \App\Http\Resources\Maestro\SedeResource
     */
    public function store(SedeStoreRequest $request)
    {
        $sede = Sede::create($request->validated());

        return new SedeResource($sede);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sede $sede
     * @return \App\Http\Resources\Maestro\SedeResource
     */
    public function show(Request $request, Sede $sede)
    {
        return new SedeResource($sede);
    }

    /**
     * @param \App\Http\Requests\Maestro\SedeUpdateRequest $request
     * @param \App\Models\Sede $sede
     * @return \App\Http\Resources\Maestro\SedeResource
     */
    public function update(SedeUpdateRequest $request, Sede $sede)
    {
        $sede->update($request->validated());

        return new SedeResource($sede);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sede $sede
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Sede $sede)
    {
        $sede->delete();

        return response()->noContent();
    }
}
