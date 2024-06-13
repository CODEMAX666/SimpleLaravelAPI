<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Jobs\ProcessSubmission;

class SubmissionService
{
    public function handleSubmission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            Log::info('Validation failed', ['errors' => $validator->errors()]);
            return [
                'data' => ['error' => $validator->errors()],
                'status' => 422
            ];
        }

        Log::info('Successfully validated the request', ['data' => $request->all()]);

        ProcessSubmission::dispatch($request->all());

        Log::info('ProcessSubmission job dispatched.');

        return [
            'data' => ['message' => 'Submission is being processed.'],
            'status' => 200
        ];
    }
}
