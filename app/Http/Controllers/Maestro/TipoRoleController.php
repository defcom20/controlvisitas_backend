<?php

namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Maestro\TipoRoleStoreRequest;
use App\Http\Requests\Maestro\TipoRoleUpdateRequest;
use App\Http\Resources\Maestro\TipoRoleCollection;
use App\Http\Resources\Maestro\TipoRoleResource;
use App\Models\TipoRole;
use Illuminate\Http\Request;

class TipoRoleController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Maestro\TipoRoleCollection
     */
    public function index(Request $request)
    {
        $tipoRoles = TipoRole::all();

        return new TipoRoleCollection($tipoRoles);
    }

    /**
     * @param \App\Http\Requests\Maestro\TipoRoleStoreRequest $request
     * @return \App\Http\Resources\Maestro\TipoRoleResource
     */
    public function store(TipoRoleStoreRequest $request)
    {
        $tipoRole = TipoRole::create($request->validated());

        return new TipoRoleResource($tipoRole);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TipoRole $tipoRole
     * @return \App\Http\Resources\Maestro\TipoRoleResource
     */
    public function show(Request $request, TipoRole $tipoRole)
    {
        return new TipoRoleResource($tipoRole);
    }

    /**
     * @param \App\Http\Requests\Maestro\TipoRoleUpdateRequest $request
     * @param \App\Models\TipoRole $tipoRole
     * @return \App\Http\Resources\Maestro\TipoRoleResource
     */
    public function update(TipoRoleUpdateRequest $request, TipoRole $tipoRole)
    {
        $tipoRole->update($request->validated());

        return new TipoRoleResource($tipoRole);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TipoRole $tipoRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TipoRole $tipoRole)
    {
        $tipoRole->delete();

        return response()->noContent();
    }
}
