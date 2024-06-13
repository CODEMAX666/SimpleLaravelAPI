<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessSubmission;
use Illuminate\Support\Facades\Log;
use App\Services\SubmissionService;

class SubmissionController extends Controller
{
    protected $submissionService;

    public function __construct(SubmissionService $submissionService)
    {
        $this->submissionService = $submissionService;
    }

    public function submit(Request $request)
    {
        $response = $this->submissionService->handleSubmission($request);

        return response()->json($response['data'], $response['status']);
    }
}
