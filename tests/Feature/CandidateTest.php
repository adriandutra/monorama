<?php

namespace Tests\Feature;

use App\Models\Candidate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CandidateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_candidate_api_can_be_rendered(): void
    {
        $response = $this->get('/lead');

        $response->assertStatus(200);
    }

    public function test_authenticate_using_the_create_candidate_api(): void
    {

        $response = $this->post('/lead', [
            'name' => "Adrian Dutra",
            'source' => "Anythind",
            'owner' => 1,
            'created_by' => 1
        ]);

        $response->assertStatus(200);
    }
}
