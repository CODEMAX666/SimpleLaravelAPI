<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Submission;
use App\Events\SubmissionSaved;
use App\Jobs\ProcessSubmission;
use App\Repositories\SubmissionRepository;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Mockery;

class ProcessSubmissionTest extends TestCase
{
    protected $submissionRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->submissionRepository = Mockery::mock(SubmissionRepository::class);
    }

    public function test_handle()
    {
        // Arrange
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        $this->submissionRepository->shouldReceive('create')
                                   ->with($data)
                                   ->andReturn(new Submission($data));

        // Mock event dispatching
        Event::fake();
        Log::shouldReceive('info')->withArgs(function ($message, $context = []) {
            return true;
        });

        // Act
        $job = new ProcessSubmission($data, $this->submissionRepository);
        $job->handle();

        // Assert
        Event::assertDispatched(SubmissionSaved::class);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
