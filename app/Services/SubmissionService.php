<?php

namespace App\Services;

use App\Http\Requests\StoreSubmissionRequest;
use App\Exceptions\SubmissionProcessingException;
use App\Jobs\ProcessSubmission;
use Illuminate\Support\Facades\Log;
use App\Repositories\SubmissionRepository;

class SubmissionService
{
    protected $submissionRepository;

    public function __construct(SubmissionRepository $submissionRepository)
    {
        $this->submissionRepository = $submissionRepository;
    }

    public function handleSubmission(StoreSubmissionRequest $request)
    {
        $validated = $request->validated();

        try {
            ProcessSubmission::dispatch($validated);
            Log::info('ProcessSubmission job dispatched.');
        } catch (\Exception $e) {
            throw new SubmissionProcessingException('Failed to dispatch ProcessSubmission job.');
        }

        return [
            'message' => 'Submission is being processed.'
        ];
    }
}
