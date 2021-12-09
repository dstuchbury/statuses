<?php

namespace App\Facades;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class EndeavourResponse extends Response
{
    public static function ok($message = null, $messageDetail = null, $data = null, $status = 200): JsonResponse
    {
        $response = [
            'meta' =>  [
                'success' => true,
                'message' => $message,
                'message_detail' => $messageDetail
            ],
            'data' => $data
        ];
        return response()->json($response, $status);
    }

    public static function badRequest($message = null, $messageDetail = null, $data = null, $errors = null, int $status = 400): JsonResponse
    {
        $response = [
            'meta' =>  [
                'success' => false,
                'message' => $message,
                'message_detail' => $messageDetail
            ],
            'data' => $data,
            'errors' => $errors
        ];
        return response()->json($response, $status);
    }

    public static function notFound($message = null, $messageDetail = null, $data = null, $errors = null, int $status = 404): JsonResponse
    {
        $response = [
            'meta' =>  [
                'success' => false,
                'message' => $message,
                'message_detail' => $messageDetail
            ],
            'data' => $data,
            'errors' => $errors
        ];
        return response()->json($response, $status);
    }

    public static function internalServerError($message = null, $messageDetail = null, $data = null, $errors = null, int $status = 500): JsonResponse
    {
        $response = [
            'meta' =>  [
                'success' => false,
                'message' => $message,
                'message_detail' => $messageDetail
            ],
            'data' => $data,
            'errors' => $errors
        ];
        return response()->json($response, $status);
    }
}
