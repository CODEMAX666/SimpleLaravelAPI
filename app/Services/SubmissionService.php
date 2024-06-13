<?php

namespace App\Services;

use App\Jobs\ProcessSubmission;
use Illuminate\Support\Facades\Log;
use App\Repositories\SubmissionRepository;
use App\Http\Requests\StoreSubmissionRequest;

class SubmissionService
{
    protected $submissionRepository;

    public function __construct(SubmissionRepository $submissionRepository)
    {
        $this->submissionRepository = $submissionRepository;
    }

    public function handleSubmission(StoreSubmissionRequest $request)
    {
        Log::info('Successfully validated the request', ['data' => $request->all()]);

        ProcessSubmission::dispatch($request->validated());

        Log::info('ProcessSubmission job dispatched.');

        return [
            'message' => 'Submission is being processed.'
        ];
    }
}
