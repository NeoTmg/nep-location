<?php

namespace Neo\NepLocation\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ResourceNotFoundException extends Exception
{
    // public function __construct(string $resource = 'Resource', int|string|null $identifier = null)
    // {
    //     $message = $resource . ($identifier ? " with ID {$identifier}" : '') . ' not found.';
    //     parent::__construct($message, 404);
    // }
    protected $id;

    public function __construct($message, $id)
    {
        $this->id = $id;
        $message = "{$message} with ID {$id} not found.";
        parent::__construct($message);
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'status' => false,
            'error' => 'Not Found',
            'message' => $this->getMessage(),
        ], 404);
    }
}
