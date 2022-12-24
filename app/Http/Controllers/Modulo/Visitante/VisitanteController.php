<?php

namespace App\Http\Controllers\Modulo\Visitante;

use App\Http\Controllers\Controller;
use App\Http\Requests\Modulo\Visitante\VisitanteStoreRequest;
use App\Http\Requests\Modulo\Visitante\VisitanteUpdateRequest;
use App\Http\Resources\Modulo\Visitante\VisitanteCollection;
use App\Http\Resources\Modulo\Visitante\VisitanteResource;
use App\Models\Visitante;
use Illuminate\Http\Request;

class VisitanteController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Modulo\Visitante\VisitanteCollection
     */
    public function index(Request $request)
    {
        $visitantes = Visitante::all();

        return new VisitanteCollection($visitantes);
    }

    /**
     * @param \App\Http\Requests\Modulo\Visitante\VisitanteStoreRequest $request
     * @return \App\Http\Resources\Modulo\Visitante\VisitanteResource
     */
    public function store(VisitanteStoreRequest $request)
    {
        $visitante = Visitante::create($request->validated());

        return new VisitanteResource($visitante);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Visitante $visitante
     * @return \App\Http\Resources\Modulo\Visitante\VisitanteResource
     */
    public function show(Request $request, Visitante $visitante)
    {
        return new VisitanteResource($visitante);
    }

    /**
     * @param \App\Http\Requests\Modulo\Visitante\VisitanteUpdateRequest $request
     * @param \App\Models\Visitante $visitante
     * @return \App\Http\Resources\Modulo\Visitante\VisitanteResource
     */
    public function update(VisitanteUpdateRequest $request, Visitante $visitante)
    {
        $visitante->update($request->validated());

        return new VisitanteResource($visitante);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Visitante $visitante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Visitante $visitante)
    {
        $visitante->delete();

        return response()->noContent();
    }
}
