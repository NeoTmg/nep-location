<?php

namespace Neo\NepLocation\traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

trait ResponseTrait
{
    /**
     * Return success response for GET requests (index/show)
     * Returns clean resource data without status/message wrapper
     */
    protected function successResponse($data, ?string $resourceClass = null)
    {  
        if ($data instanceof JsonResource || $data instanceof AnonymousResourceCollection) {
            return $data->additional([
                'status' => 200,
                'message' => 'Success',
            ]);
        }
 
        if ($resourceClass && class_exists($resourceClass)) {
            if ($data instanceof LengthAwarePaginator || is_iterable($data)) {
                return $resourceClass::collection($data)->additional([
                    'status' => 200,
                    'message' => 'Success',
                ]);
            } else {
                return (new $resourceClass($data))->additional([
                    'status' => 200,
                    'message' => 'Success',
                ]);
            }
        } 
        return response()->json([
            'status' => 200,
            'message' => 'Success',
            'data' => $data,
        ], 200);
    }

    /**
     * Return success response for CREATE operations (POST)
     * Returns status + message + resource data with 201 status
     */
    protected function createdResponse($data, string $message = 'Resource created successfully', ?string $resourceClass = null): JsonResponse
    {
        $responseData = [
            'status' => true,
            'message' => $message,
        ];

        // Transform data using resource if provided
        if ($resourceClass && class_exists($resourceClass)) {
            $responseData['data'] = new $resourceClass($data);
        } else {
            $responseData['data'] = $data;
        }

        return response()->json($responseData, 201);
    }

    /**
     * Return success response for UPDATE operations (PUT/PATCH)
     * Returns status + message + resource data with 200 status
     */
    protected function updatedResponse($data, string $message = 'Resource updated successfully', ?string $resourceClass = null): JsonResponse
    {
        $responseData = [
            'status' => true,
            'message' => $message,
        ];

        // Transform data using resource if provided
        if ($resourceClass && class_exists($resourceClass)) {
            $responseData['data'] = new $resourceClass($data);
        } else {
            $responseData['data'] = $data;
        }

        return response()->json($responseData, 200);
    }

    /**
     * Return success response for DELETE operations
     * Returns status + message with 200 status
     */
    protected function deletedResponse(string $message = 'Resource deleted successfully'): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
        ], 200);
    }

    /**
     * Return success response for DELETE operations (minimal)
     * Returns empty response with 204 status
     */
    protected function deletedNoContentResponse(): JsonResponse
    {
        return response()->json(null, 204);
    }

    /**
     * Return not found error response
     * Returns status + error + message with 404 status
     */
    protected function notFoundResponse(string $resource = 'Resource', $id = null): JsonResponse
    {
        $message = $id
            ? "{$resource} with ID {$id} not found."
            : "{$resource} not found.";

        return response()->json([
            'status' => false,
            'error' => 'Not Found',
            'message' => $message,
        ], 404);
    }

    /**
     * Return validation error response
     * Returns status + error + message + errors with 422 status
     */
    protected function validationErrorResponse($errors, string $message = 'The given data was invalid.'): JsonResponse
    {
        return response()->json([
            'status' => false,
            'error' => 'Validation Error',
            'message' => $message,
            'errors' => $errors,
        ], 422);
    }

    /**
     * Return bad request error response
     * Returns status + error + message with 400 status
     */
    protected function badRequestResponse(string $message = 'Bad request.'): JsonResponse
    {
        return response()->json([
            'status' => false,
            'error' => 'Bad Request',
            'message' => $message,
        ], 400);
    }

    /**
     * Return server error response
     * Returns status + error + message with 500 status
     */
    protected function serverErrorResponse(string $message = 'Internal server error.'): JsonResponse
    {
        return response()->json([
            'status' => false,
            'error' => 'Server Error',
            'message' => $message,
        ], 500);
    }

    /**
     * Return unauthorized error response
     * Returns status + error + message with 401 status
     */
    protected function unauthorizedResponse(string $message = 'Unauthorized access.'): JsonResponse
    {
        return response()->json([
            'status' => false,
            'error' => 'Unauthorized',
            'message' => $message,
        ], 401);
    }

    /**
     * Return forbidden error response
     * Returns status + error + message with 403 status
     */
    protected function forbiddenResponse(string $message = 'Access forbidden.'): JsonResponse
    {
        return response()->json([
            'status' => false,
            'error' => 'Forbidden',
            'message' => $message,
        ], 403);
    }

    /**
     * Find model or return not found response
     * Helper method to reduce repetitive code
     */
    protected function findOrFail($modelClass, $id, ?string $resourceName = null)
    {
        $model = $modelClass::find($id);

        if (! $model) {
            $resourceName = $resourceName ?: class_basename($modelClass);

            return $this->notFoundResponse($resourceName, $id);
        }

        return $model;
    }

    /**
     * Custom success response with flexible parameters
     * For any other custom success scenarios
     */
    protected function customSuccessResponse($data = null, ?string $message = null, int $statusCode = 200): JsonResponse
    {
        $response = ['status' => true];

        if ($message) {
            $response['message'] = $message;
        }

        if ($data !== null) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Custom error response with flexible parameters
     * For any other custom error scenarios
     */
    protected function customErrorResponse(string $error, string $message, int $statusCode = 400, $additionalData = null): JsonResponse
    {
        $response = [
            'status' => false,
            'error' => $error,
            'message' => $message,
        ];

        if ($additionalData) {
            $response = array_merge($response, $additionalData);
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Returns an error response.
     */
    public function errorResponse(string $msg, int $status = 404): JsonResponse
    {
        $response = [
            'status' => $status,
            'message' => $msg,
        ];

        return response()->json($response, $status);
    }

    /**
     * if any type error
     */
    public function checkError($msg)
    {
        if (request()->query('checkError')) {
            dd($msg);
        }
    }
}
