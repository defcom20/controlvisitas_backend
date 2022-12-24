<?php

namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Maestro\TipoPermisoStoreRequest;
use App\Http\Requests\Maestro\TipoPermisoUpdateRequest;
use App\Http\Resources\Maestro\TipoPermisoCollection;
use App\Http\Resources\Maestro\TipoPermisoResource;
use App\Models\TipoPermiso;
use Illuminate\Http\Request;

class TipoPermisoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Maestro\TipoPermisoCollection
     */
    public function index(Request $request)
    {
        $tipoPermisos = TipoPermiso::all();

        return new TipoPermisoCollection($tipoPermisos);
    }

    /**
     * @param \App\Http\Requests\Maestro\TipoPermisoStoreRequest $request
     * @return \App\Http\Resources\Maestro\TipoPermisoResource
     */
    public function store(TipoPermisoStoreRequest $request)
    {
        $tipoPermiso = TipoPermiso::create($request->validated());

        return new TipoPermisoResource($tipoPermiso);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TipoPermiso $tipoPermiso
     * @return \App\Http\Resources\Maestro\TipoPermisoResource
     */
    public function show(Request $request, TipoPermiso $tipoPermiso)
    {
        return new TipoPermisoResource($tipoPermiso);
    }

    /**
     * @param \App\Http\Requests\Maestro\TipoPermisoUpdateRequest $request
     * @param \App\Models\TipoPermiso $tipoPermiso
     * @return \App\Http\Resources\Maestro\TipoPermisoResource
     */
    public function update(TipoPermisoUpdateRequest $request, TipoPermiso $tipoPermiso)
    {
        $tipoPermiso->update($request->validated());

        return new TipoPermisoResource($tipoPermiso);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TipoPermiso $tipoPermiso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TipoPermiso $tipoPermiso)
    {
        $tipoPermiso->delete();

        return response()->noContent();
    }
}
