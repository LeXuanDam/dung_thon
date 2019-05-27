<?php

namespace App\Services;


class ResponseService
{
    public function json($result, $message = null, $data = null)
    {
        return response()->json([
            'result' => $result,
            'message' => $message,
            'data' => $data
        ]);
    }
}
