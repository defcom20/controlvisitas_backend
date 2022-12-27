<?php

namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Maestro\AreaStoreRequest;
use App\Http\Requests\Maestro\AreaUpdateRequest;
use App\Http\Resources\Maestro\AreaResource;
use App\Models\Area;
use App\Models\TipoEstado;
use App\Traits\HttpResponses;
use App\Traits\ValidatePermiso;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    use HttpResponses, ValidatePermiso;

    protected $area;
    protected $estado;

    public function __construct(Area $area, TipoEstado $estado)
    {
        $this->area = $area;
        $this->estado = $estado;
    }

    public function index()
    {
        $area = $this->area->get();
        $estado = $this->estado->where("switch", "CC")->get();
        //$estado = $this->estado->get();

        $data = [
            "area" => $area,
            "estado" => $estado
        ];

        return $this->successResponse($data, 'Show Area.');
    }

    /**
     * @param \App\Http\Requests\Maestro\AreaStoreRequest $request
     * @return \App\Http\Resources\Maestro\AreaResource
     */
    public function store(AreaStoreRequest $request)
    {

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Area $area
     * @return \App\Http\Resources\Maestro\AreaResource
     */
    public function show(Request $request, Area $area)
    {
        return new AreaResource($area);
    }

    /**
     * @param \App\Http\Requests\Maestro\AreaUpdateRequest $request
     * @param \App\Models\Area $area
     * @return \App\Http\Resources\Maestro\AreaResource
     */
    public function update(AreaUpdateRequest $request, Area $area)
    {
        $area->update($request->validated());

        return new AreaResource($area);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Area $area)
    {
        $area->delete();

        return response()->noContent();
    }
}
