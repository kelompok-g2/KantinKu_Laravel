<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class RenderApiErrors
{
    public function __invoke(Response $response, Throwable $exception, Request $request): Response
    {
        if (! $request->is('api', 'api/*') || ! $response->isClientError() && ! $response->isServerError()) {
            return $response;
        }

        $status = $response->getStatusCode();
        $body = json_decode((string) $response->getContent(), true);
        $payload = [
            'status' => 'error',
            'message' => $status >= 500 ? 'Terjadi kesalahan pada server.' : ($body['message'] ?? Response::$statusTexts[$status] ?? 'Request gagal.'),
            'data' => null,
        ];

        if ($exception instanceof ValidationException) {
            $payload['errors'] = $exception->errors();
        }

        $headers = $response->headers->all();
        unset($headers['content-type'], $headers['content-length']);

        return response()->json($payload, $status, $headers);
    }
}
