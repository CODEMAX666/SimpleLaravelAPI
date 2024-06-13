
<?php

use Tests\TestCase;
use App\Services\SubmissionService;
use App\Repositories\SubmissionRepository;
use App\Http\Requests\StoreSubmissionRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use App\Models\Submission;

class SubmissionServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $submissionService;
    protected $submissionRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->submissionRepository = Mockery::mock(SubmissionRepository::class);
        $this->app->instance(SubmissionRepository::class, $this->submissionRepository);

        $this->submissionService = $this->app->make(SubmissionService::class);
    }

    public function test_handle_submission()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        $request = StoreSubmissionRequest::create('/api/submit', 'POST', $data);

        $this->submissionRepository->shouldReceive('create')
                                   ->once()
                                   ->with($data)
                                   ->andReturn(new Submission($data));

        $response = $this->submissionService->handleSubmission($request);

        $this->assertEquals('Submission is being processed.', $response['message']);
    }
}
