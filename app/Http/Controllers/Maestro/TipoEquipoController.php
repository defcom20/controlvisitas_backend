<?php

namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Maestro\TipoEquipoStoreRequest;
use App\Http\Requests\Maestro\TipoEquipoUpdateRequest;
use App\Http\Resources\Maestro\TipoEquipoCollection;
use App\Http\Resources\Maestro\TipoEquipoResource;
use App\Maestro\TipoEquipo;
use App\Maestro\tipoEquipo;
use Illuminate\Http\Request;

class TipoEquipoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Maestro\TipoEquipoCollection
     */
    public function index(Request $request)
    {
        $tipoEquipos = TipoEquipo::all();

        return new TipoEquipoCollection($tipoEquipos);
    }

    /**
     * @param \App\Http\Requests\Maestro\TipoEquipoStoreRequest $request
     * @return \App\Http\Resources\Maestro\TipoEquipoResource
     */
    public function store(TipoEquipoStoreRequest $request)
    {
        $tipoEquipo = TipoEquipo::create($request->validated());

        return new TipoEquipoResource($tipoEquipo);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Maestro\tipoEquipo $tipoEquipo
     * @return \App\Http\Resources\Maestro\TipoEquipoResource
     */
    public function show(Request $request, TipoEquipo $tipoEquipo)
    {
        return new TipoEquipoResource($tipoEquipo);
    }

    /**
     * @param \App\Http\Requests\Maestro\TipoEquipoUpdateRequest $request
     * @param \App\Maestro\tipoEquipo $tipoEquipo
     * @return \App\Http\Resources\Maestro\TipoEquipoResource
     */
    public function update(TipoEquipoUpdateRequest $request, TipoEquipo $tipoEquipo)
    {
        $tipoEquipo->update($request->validated());

        return new TipoEquipoResource($tipoEquipo);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Maestro\tipoEquipo $tipoEquipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TipoEquipo $tipoEquipo)
    {
        $tipoEquipo->delete();

        return response()->noContent();
    }
}
