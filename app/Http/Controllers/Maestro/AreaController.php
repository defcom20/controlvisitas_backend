<?php

namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Maestro\AreaStoreRequest;
use App\Http\Requests\Maestro\AreaUpdateRequest;
use App\Http\Resources\Maestro\AreaCollection;
use App\Http\Resources\Maestro\AreaResource;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Maestro\AreaCollection
     */
    public function index(Request $request)
    {
        $areas = Area::all();

        return new AreaCollection($areas);
    }

    /**
     * @param \App\Http\Requests\Maestro\AreaStoreRequest $request
     * @return \App\Http\Resources\Maestro\AreaResource
     */
    public function store(AreaStoreRequest $request)
    {
        $area = Area::create($request->validated());

        return new AreaResource($area);
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
