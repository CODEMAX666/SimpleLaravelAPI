<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessSubmission;
use Illuminate\Support\Facades\Log;
use App\Services\SubmissionService;

/**
 * @OA\Info(title="My API", version="1.0")
 */
class SubmissionController extends Controller
{
    protected $submissionService;

    public function __construct(SubmissionService $submissionService)
    {
        $this->submissionService = $submissionService;
    }

    /**
     * @OA\Post(
     *     path="/submit",
     *     summary="Submit data",
     *     description="Submit data for processing",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *             @OA\Property(property="message", type="string", example="Hello, this is a message.")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Submission is being processed."),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function submit(Request $request)
    {
        $response = $this->submissionService->handleSubmission($request);

        return response()->json($response['data'], $response['status']);
    }
}
