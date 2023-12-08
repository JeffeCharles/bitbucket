<?php

namespace App\Traits;

trait HttpResponces {
    protected function success($data, $message = null, $code = 200){
        return responce()->json([
            'status' => 'Request was successful.',
            'message' => $message,
            'data' => $data
        ], $code);

    }

    protected function error($data, $message = null, $code){
        return responce()->json([
            'status' => 'Error has occured.',
            'message' => $message,
            'data' => $data
        ], $code);

    }
}