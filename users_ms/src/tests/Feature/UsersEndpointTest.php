<?php

namespace Tests\Feature;

use App\Jobs\UserStoredNotificationJob;
use Tests\TestCase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersEndpointTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Queue::fake();
    }

    public function test_posted_data_is_stored(): void
    {
        $response = $this->post(
            '/users',
            [
                'email' => 'john.doe@example.com',
                'firstName' => 'John',
                'lastName' => 'Doe'
            ]
        );

        $response->assertStatus(201);
        $this->assertDatabaseHas(
            'users',
            [
                'email' => 'john.doe@example.com',
                'first_name' => 'John',
                'last_name' => 'Doe',
            ]
        );
        Queue::assertPushed(UserStoredNotificationJob::class);
    }

    public function test_fails_when_posting_invalid_email(): void
    {
        $response = $this->post(
            '/users',
            [
                'email' => 'john.doe<at>example.com',
                'firstName' => 'John',
                'lastName' => 'Doe'
            ]
        );
        $response->assertStatus(302);
        Queue::assertNothingPushed();
    }

    public function test_fails_when_posting_incomplete_data(): void
    {
        $response = $this->post(
            '/users',
            [
                'email' => 'john.doe@example.com',
            ]
        );
        $response->assertStatus(302);
        Queue::assertNothingPushed();
    }

    public function test_fails_when_posting_empty_name(): void
    {
        $response = $this->post(
            '/users',
            [
                'email' => 'john.doe@example.com',
                'firstName' => '',
                'lastName' => '',
            ]
        );
        $response->assertStatus(302);
        Queue::assertNothingPushed();
    }
}
