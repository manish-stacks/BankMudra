<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     */

public function render($request, Throwable $exception)
{
    // Catch Laravel's AuthorizationException
    if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
        return response()->view('errors.permission-403', ['message' => 'You are not authorized to perform this action.'], 403);
    }

    // Catch Spatie's 403 exception
    if ($exception instanceof HttpException && $exception->getStatusCode() === 403) {
        return response()->view('errors.permission-403', ['message' => 'Access denied. You don’t have the required permission.'], 403);
    }

    return parent::render($request, $exception);
}

}
    