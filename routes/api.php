<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::apiResource('user', App\Http\Controllers\Modulo\Usuario\UserController::class);

Route::apiResource('permiso', App\Http\Controllers\Modulo\Usuario\PermisoController::class);

Route::apiResource('visitante', App\Http\Controllers\Modulo\Visitante\VisitanteController::class);

Route::apiResource('tipo-equipo', App\Http\Controllers\Maestro\TipoEquipoController::class);

Route::apiResource('tipo-role', App\Http\Controllers\Maestro\TipoRoleController::class);

Route::apiResource('tipo-permiso', App\Http\Controllers\Maestro\TipoPermisoController::class);

Route::apiResource('sede', App\Http\Controllers\Maestro\SedeController::class);

Route::apiResource('area', App\Http\Controllers\Maestro\AreaController::class);
