<?php

namespace App\Traits;

use App\Models\Permiso;
use App\Models\UserSede;
use Illuminate\Support\Facades\DB;

trait ValidatePermiso
{
    protected function isAuthorization($id_submodulo, $permiso = '', $code = 403)
    {
        $idUser = auth()->user()->id;

        try {
            if ($idUser == 1) return true;
            $response = Permiso::where('user_id', $idUser)->where('user_sede_id', $id_submodulo)->first();
            $res = $response->habilidades;

            if (!empty($res[0])) {
                if (in_array($permiso, $res)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
