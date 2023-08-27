<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

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

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return redirect()->route('not-found'); // Redirect to a custom error page or route
        } elseif ($exception instanceof ThrottleRequestsException) {
            return redirect()->back()->with([
                'error' => [
                    'message' => 'Rate limit exceeded. Please try again later.',
                    'status' => 429, // You can use this status code in your view
                ],
            ]);
        }

        return parent::render($request, $exception);
    }
}
