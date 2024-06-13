<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubmissionRequest;
use App\Http\Resources\SubmissionResource;
use App\Services\SubmissionService;
use App\Exceptions\SubmissionValidationException;
use App\Exceptions\SubmissionProcessingException;

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
     *     path="/submissions",
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
    public function store(StoreSubmissionRequest $request)
    {
        try {
            $response = $this->submissionService->handleSubmission($request);
        } catch (SubmissionValidationException $e) {
            return $e->render($request);
        } catch (SubmissionProcessingException $e) {
            return $e->render($request);
        }

        return response()->json($response, 200);
    }
}
