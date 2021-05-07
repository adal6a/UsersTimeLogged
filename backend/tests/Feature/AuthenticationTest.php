<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanAuthenticate()
    {
        $password = 'test';

        $user = User::factory()->create([
            'password' => bcrypt($password)
        ]);

        $response = $this->json('POST', '/api/v1/login', [
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertStatus(200);
    }
}
