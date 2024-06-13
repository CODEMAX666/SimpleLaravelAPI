<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class SubmissionValidationException extends Exception
{
    protected $errors;

    public function __construct($errors)
    {
        parent::__construct('Validation Error');
        $this->errors = $errors;
    }

    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
            'errors' => $this->errors,
        ], 422);
    }
}
