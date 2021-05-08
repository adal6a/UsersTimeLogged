<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanListUsers()
    {
        $password = 'test';

        $user = User::factory()->create([
            'password' => bcrypt($password)
        ]);

        Sanctum::actingAs(
            $user,
            ['*']
        );

        $response = $this->json('GET', '/api/v1/users');

        $response->assertJsonStructure([
            'message',
            'error',
            'code',
            'data' => [
                'current_page',
                'data'
            ]
        ]);

        $response->assertJson([
            'error' => false,
            'code' => 200
        ]);
    }
}
