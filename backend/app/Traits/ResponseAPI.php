<?php


namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseAPI
{
    public function response($message, $data, $statusCode, $isSuccess = true): JsonResponse
    {
        if($isSuccess) {
            return response()->json([
                'message' => $message,
                'error' => false,
                'code' => $statusCode,
                'data' => $data
            ], $statusCode);
        } else {
            return response()->json([
                'message' => $message,
                'error' => true,
                'code' => $statusCode,
            ], $statusCode);
        }
    }

    public function success($message, $data, $statusCode = 200)
    {
        return $this->response($message, $data, $statusCode);
    }

    public function error($message, $statusCode = 500)
    {
        return $this->response($message, null, $statusCode, false);
    }
}
