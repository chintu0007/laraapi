<?php

namespace App\Traits;

trait ApiResources
{

    public function ok($data = [], $message = '', $code = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'code' => 200
        ]);
    }

    public function  errors($errors = [], $code=401)
    {
        return response()->json([
            'errors' => $errors,
            'code' => $code
        ]);
    }
}
