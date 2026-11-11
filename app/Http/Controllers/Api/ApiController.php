<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class ApiController extends Controller
{
    protected function success(string $message, mixed $data = null, int $status = 200): JsonResponse
    {
        $body = ['status' => 'success', 'message' => $message, 'data' => $data];

        if ($data instanceof LengthAwarePaginator) {
            $body['data'] = $data->items();
            $body['meta'] = [
                'current_page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'last_page' => $data->lastPage(),
                'total' => $data->total(),
            ];
        }

        return response()->json($body, $status);
    }
}
