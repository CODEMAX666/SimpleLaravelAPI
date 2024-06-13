<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class SubmissionProcessingException extends Exception
{
    public function __construct($message = 'Submission Processing Error')
    {
        parent::__construct($message);
    }

    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
        ], 500);
    }
}
