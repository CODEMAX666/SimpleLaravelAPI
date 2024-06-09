<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use Illuminate\Support\Facades\Log;

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
}
