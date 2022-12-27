<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Maestro\AreaController;
use App\Http\Controllers\Maestro\SedeController;
use App\Http\Controllers\Maestro\TipoPermisoController;
use App\Http\Controllers\Maestro\TipoRoleController;
use App\Http\Controllers\Modulo\Usuario\PermisoController;
use App\Http\Controllers\Modulo\Usuario\UserController;
use App\Http\Controllers\Modulo\Visitante\VisitanteController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [UserController::class, 'store']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/marcar/{id}', [VisitanteController::class, 'marcar']);

    Route::apiResources([
        'user' => UserController::class,
        'permiso' => PermisoController::class,
        'visitante' => VisitanteController::class,
        'tipo-role' => TipoRoleController::class,
        'tipo-permiso' => TipoPermisoController::class,
        'sede' => SedeController::class,
        'area' => AreaController::class,
    ]);
});
