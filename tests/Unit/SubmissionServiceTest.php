<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\SubmissionService;
use App\Models\Submission;
use App\Http\Requests\StoreSubmissionRequest;
use App\Jobs\ProcessSubmission;
use App\Repositories\SubmissionRepository;
use App\DTOs\SubmissionDTO;

use Illuminate\Support\Facades\Bus;
use Mockery;

class SubmissionServiceTest extends TestCase
{
    protected $submissionService;
    protected $submissionRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->submissionRepository = Mockery::mock(SubmissionRepository::class);
        $this->submissionService = new SubmissionService($this->submissionRepository);
    }

    public function test_handle_submission()
    {
        // Arrange
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        // Create a SubmissionDTO
        $submissionDTO = new SubmissionDTO($data);

        // Create a mock StoreSubmissionRequest
        $request = Mockery::mock(StoreSubmissionRequest::class)->makePartial();
        $request->shouldReceive('validated')->andReturn($data);
        // Mock the job dispatch
        Bus::fake();

        // Act
        $this->submissionService->handleSubmission($submissionDTO);

        // Assert
        Bus::assertDispatched(ProcessSubmission::class, function ($job) use ($data) {
            return $job->getData() == $data;
        });
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
