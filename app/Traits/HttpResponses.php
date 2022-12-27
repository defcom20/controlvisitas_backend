<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait HttpResponses
{

    protected function successResponse($data = null, $messsage = '', $code = 200)
    {
        $mensaje = $messsage . ' successfully.';
        return $this->succes($data, $mensaje, $code);
    }

    protected function errorResponse($data = null, $messsage = 'Id no se pudo encontrar.', $code = 403)
    {
        // return $this->error('', 'ID ' . $id . ' no se pudo encontrar.', $code);
        return $this->error($data, $messsage, $code);
    }

    protected function succes($data, $messsage, $code)
    {
        return response()->json([
            'version'  => '1.0',
            'success'  => true,
            'message' => $messsage,
            'data'    => $data
        ], $code);
    }

    protected function error($data, $messsage, $code)
    {
        return response()->json([
            'version'  => '1.0',
            'success'  => false,
            'message' => $messsage,
            'data'    => $data
        ], $code);
    }

    public function refreshDB($tabla)
    {

        DB::statement("ALTER TABLE" . $tabla . "AUTO_INCREMENT =  1");
    }
}
