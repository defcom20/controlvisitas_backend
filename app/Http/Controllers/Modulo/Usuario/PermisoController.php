<?php

namespace App\Http\Controllers\Modulo\Usuario;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modulo\Usuario\PermisoStoreRequest;
use App\Http\Requests\Modulo\Usuario\PermisoUpdateRequest;
use App\Http\Resources\Modulo\Usuario\PermisoCollection;
use App\Http\Resources\Modulo\Usuario\PermisoResource;
use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Modulo\Usuario\PermisoCollection
     */
    public function index(Request $request)
    {
        $permisos = Permiso::all();

        return new PermisoCollection($permisos);
    }

    /**
     * @param \App\Http\Requests\Modulo\Usuario\PermisoStoreRequest $request
     * @return \App\Http\Resources\Modulo\Usuario\PermisoResource
     */
    public function store(PermisoStoreRequest $request)
    {
        $permiso = Permiso::create($request->validated());

        return new PermisoResource($permiso);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Permiso $permiso
     * @return \App\Http\Resources\Modulo\Usuario\PermisoResource
     */
    public function show(Request $request, Permiso $permiso)
    {
        return new PermisoResource($permiso);
    }

    /**
     * @param \App\Http\Requests\Modulo\Usuario\PermisoUpdateRequest $request
     * @param \App\Models\Permiso $permiso
     * @return \App\Http\Resources\Modulo\Usuario\PermisoResource
     */
    public function update(PermisoUpdateRequest $request, Permiso $permiso)
    {
        $permiso->update($request->validated());

        return new PermisoResource($permiso);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Permiso $permiso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Permiso $permiso)
    {
        $permiso->delete();

        return response()->noContent();
    }
}
