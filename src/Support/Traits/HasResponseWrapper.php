<?php

namespace Support\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait HasResponseWrapper
{
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
}
