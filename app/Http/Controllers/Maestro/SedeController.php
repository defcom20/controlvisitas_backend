<?php

namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Maestro\SedeStoreRequest;
use App\Http\Requests\Maestro\SedeUpdateRequest;
use App\Http\Resources\Maestro\SedeCollection;
use App\Http\Resources\Maestro\SedeResource;
use App\Models\Sede;
use Illuminate\Http\Request;

class SedeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Maestro\SedeCollection
     */
    public function index(Request $request)
    {
        $sedes = Sede::all();

        return new SedeCollection($sedes);
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
