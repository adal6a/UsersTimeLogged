<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseTransactions;

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

    public function testUserCanLogout()
    {
        $password = 'test';

        $user = User::factory()->create([
            'password' => bcrypt($password)
        ]);

        Sanctum::actingAs(
            $user,
            ['*']
        );

        $response = $this->json('GET', '/api/v1/logout');

        $response->assertStatus(200);
    }
}
