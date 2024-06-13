<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;
use App\Models\Submission;

class SubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_submission_endpoint()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        Log::info('Starting test_submission_endpoint');

        $response = $this->postJson('/api/submit', $data);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Submission is being processed.']);

        $this->assertDatabaseHas('submissions', $data);

        Log::info('Completed test_submission_endpoint');
    }

    public function test_submission_endpoint_validation_error()
    {
        $data = [
            'name' => '',
            'email' => 'not-an-email',
            'message' => '',
        ];

        Log::info('Starting test_submission_endpoint_validation_error');

        $response = $this->postJson('/api/submit', $data);

        $response->assertStatus(422)
                 ->assertJsonStructure(['message', 'errors' => ['name', 'email', 'message']]);

        $this->assertDatabaseMissing('submissions', ['email' => 'not-an-email']);

        Log::info('Completed test_submission_endpoint_validation_error');
    }
}
