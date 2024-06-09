<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessSubmission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SubmissionController extends Controller
{
    //
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        Log::info('1234 submission:', $request->all());

        // Dispatch the job to process the submission
        ProcessSubmission::dispatch($request->all());

        Log::info('ProcessSubmission job dispatched.');

        return response()->json(['message' => 'Submission is being processed.'], 200);
    }
}
