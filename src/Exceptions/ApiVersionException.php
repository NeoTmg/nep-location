<?php

namespace Neo\NepLocation\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ApiVersionException extends Exception
{
    public function __construct()
    {
        $message = 'Unsupported API Version.';
        parent::__construct($message);
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'status' => false,
            'error' => 'API Version',
            'message' => $this->getMessage(),
        ], 404);
    }
}
