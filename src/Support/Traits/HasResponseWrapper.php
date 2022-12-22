<?php

namespace Support\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait HasResponseWrapper
{
    public function getToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function addSuccess(string $name): JsonResponse
    {
        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => $name . ' успешно добавлен(a)',
        ]);
    }

    public function updateSuccess(string $name): JsonResponse
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => $name . ' успешно обновлен(а)',
        ]);
    }

    public function deleteSuccess(string $name): JsonResponse
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => $name . ' успешно удален(а)',
        ]);
    }

    public function missing(string $name): JsonResponse
    {
        return response()->json([
            'status' => Response::HTTP_NOT_FOUND,
            'message' => 'Нет такой ' . $name,
        ]);
    }

    public function message(string $message): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ]);
    }

    public function amount(int $amount): JsonResponse
    {
        return response()->json([
            'amount' => $amount,
        ]);
    }
}
