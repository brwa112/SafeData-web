<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Validation\ValidationException;
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

        // Handle file upload size errors gracefully
        $this->renderable(function (PostTooLargeException $e, $request) {
            if ($request->expectsJson() || $request->header('X-Inertia')) {
                throw ValidationException::withMessages([
                    'file' => [__('validation.file_too_large', ['max' => '30MB'])],
                ]);
            }

            return back()->withErrors([
                'file' => __('validation.file_too_large', ['max' => '30MB']),
            ]);
        });
    }
}
