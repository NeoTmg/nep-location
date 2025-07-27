<?php

namespace Neo\NepLocation\Exceptions;
 
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Neo\NepLocation\traits\ResponseTrait;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ResponseTrait;

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        // Log reportable exceptions if needed
        $this->reportable(function (Throwable $e) {
            Log::error($e->getMessage(), ['exception' => $e]);
        });

        // Custom exceptions with JSON rendering
        $this->renderable(function (ResourceNotFoundException $e, Request $request) {
            if ($request->expectsJson()) {
                return $e->render($request);
            }
        });

        $this->renderable(function (ResourceExistException $e, Request $request) {
            if ($request->expectsJson()) {
                return $e->render($request);
            }
        });

        $this->renderable(function (ApiVersionException $e, Request $request) {
            if ($request->expectsJson()) {
                return $e->render($request);
            }
        });

        // Handle Method Not Allowed HTTP Exception
        $this->renderable(function (MethodNotAllowedHttpException $e, Request $request) {
            if ($request->expectsJson()) {
                $allowedMethods = $e->getHeaders()['Allow'] ?? 'GET, HEAD';

                return response()->json([
                    'success' => false,
                    'error' => [
                        'code' => 'METHOD_NOT_ALLOWED',
                        'message' => "The {$request->method()} method is not supported for route {$request->path()}.",
                        'details' => "Supported methods: {$allowedMethods}",
                        'route' => $request->path(),
                        'requested_method' => $request->method(),
                    ],
                ], 405, ['Allow' => $allowedMethods]);
            }
        });
    }

    /**
     * Override the render method to customize response
     */
    public function render($request, Throwable $exception)
    {
        $statusCode = $this->getStatusCode($exception);
        $isApiRequest = $request->expectsJson() || $request->is('api/*');

        if (! app()->environment('local') && $statusCode !== 404) {
            Log::error($exception->getMessage(), ['exception' => $exception]);
        }

        return match ($statusCode) {
            404 => $isApiRequest
                ? $this->errorResponse(__('error.url_not_found'), 404)
                : response()->view('errors.404', [], 404),

            405 => $isApiRequest
                ? $this->errorResponse(__('error.method_not_allowed'), 405)
                : response()->view('errors.405', [], 405),

            406 => $isApiRequest
                ? $this->errorResponse(__('error.not_applicable'), 406)
                : response()->view('errors.406', [], 406),

            410 => $isApiRequest
                ? $this->errorResponse(__('error.resource_gone'), 410)
                : response()->view('errors.410', [], 410),

            415 => $isApiRequest
                ? $this->errorResponse(__('error.unsupported_media_type'), 415)
                : response()->view('errors.415', [], 415),

            429 => $isApiRequest
                ? $this->errorResponse(__('error.to_many_request'), 429)
                : response()->view('errors.429', [], 429),

            500 => $isApiRequest
                ? $this->errorResponse(__('error.something_went_wrong'), 500)
                : response()->view('errors.500', [], 500),

            default => parent::render($request, $exception),
        };
    }

    /**
     * Get HTTP status code from exception
     */
    protected function getStatusCode(Throwable $exception): int
    {
        if ($exception instanceof HttpException) {
            return $exception->getStatusCode();
        }

        return ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
    }
}
