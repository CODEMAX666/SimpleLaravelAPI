
<?php

use Tests\TestCase;
use Mockery;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;


use App\Services\SubmissionService;
use App\Repositories\SubmissionRepository;
use App\Http\Requests\StoreSubmissionRequest;
use App\Models\Submission;
use App\Jobs\ProcessSubmission;
use App\DTOs\SubmissionDTO;

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

        $this->submissionService = new SubmissionService($this->submissionRepository);
    }

    public function test_handle_submission()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        Log::info('Starting handle_submission_endpoint !!!!!!!!!!!');
        // Create a SubmissionDTO
        $submissionDTO = new SubmissionDTO($data);

        // Create a mock StoreSubmissionRequest
        $request = Mockery::mock(StoreSubmissionRequest::class)->makePartial();
        $request->shouldReceive('validated')
                //->once()
                ->andReturnUsing(function () use ($data) {
                    // Log the data to see what is received
                    Log::info('Validated data received in test:', $data);
                    return $data;
                });

       
        Log::info('***********************');

        // Mock the validated method to return the expected data
        

        $this->submissionRepository->shouldReceive('create')
                                //    ->once()
                                   ->with($data)
                                   ->andReturn(new Submission($data));

        // Mock the job dispatch
        Bus::fake();
        

        // Act
        $this->submissionService->handleSubmission($submissionDTO);

        // Assert
        Bus::assertDispatched(ProcessSubmission::class, function ($job) use ($data) {
            return $job->getData() == $data;
        });

        Log::info('&&&&&&&&&&&&&&&&&&&&&&&&');
    }
}
