<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

use App\Http\Requests\StoreSubmissionRequest;
use App\Exceptions\SubmissionProcessingException;
use App\Jobs\ProcessSubmission;
use App\Repositories\SubmissionRepository;
use App\DTOs\SubmissionDTO;

class SubmissionService
{
    protected $submissionRepository;

    public function __construct(SubmissionRepository $submissionRepository)
    {
        $this->submissionRepository = $submissionRepository;
    }

    public function handleSubmission(SubmissionDTO $submissionDTO)
    {
        Log::info('@@@@@@@@@@@@@@@@@@@@@@@@@1234');
        $data = [
            'name' => $submissionDTO->name,
            'email' => $submissionDTO->email,
            'message' => $submissionDTO->message,
        ];

        try {
            ProcessSubmission::dispatch($data, $this->submissionRepository);
            Log::info('ProcessSubmission job dispatched.');
        } catch (\Exception $e) {
            throw new SubmissionProcessingException('Failed to dispatch ProcessSubmission job.');
        }
        Log::info('###############################');
        return [
            'message' => 'Submission is being processed.'
        ];
    }
}
