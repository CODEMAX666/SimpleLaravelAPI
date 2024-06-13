<?php

namespace App\Jobs;

use App\Models\Submission;
use App\Events\SubmissionSaved;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Repositories\SubmissionRepository;

class ProcessSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $submissionRepository;

    public function __construct(array $data, SubmissionRepository $submissionRepository)
    {
        $this->data = $data;
        $this->submissionRepository = $submissionRepository;
    }

    public function handle()
    {
        Log::info('Processing submission in ProcessSubmission job with data:', $this->data);

        $submission = $this->submissionRepository->create($this->data);

        Log::info('Submission processed and saved to database.');

        event(new SubmissionSaved($submission));

        Log::info('SubmissionSaved event dispatched.');
    }
}
