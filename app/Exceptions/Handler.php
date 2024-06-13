<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        SubmissionValidationException::class,
        SubmissionProcessingException::class,
    ];

    public function register()
    {
        $this->renderable(function (SubmissionValidationException $e, $request) {
            return $e->render($request);
        });

        $this->renderable(function (SubmissionProcessingException $e, $request) {
            return $e->render($request);
        });
    }
}