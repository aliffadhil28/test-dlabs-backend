<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_register(): void
    {
        $name = 'John Doe';
        $email = 'john.doe1@example.com';
        $password = 'password';
        $age = 30;
        $response = $this->post('/api/register',[
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'age' => $age
        ]);

        $response->assertStatus(201);
    }

    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
        $email = 'john.doe1@example.com';
        $password = 'password';
        $response = $this->post('/api/login',[
            'email' => $email,
            'password' => $password
        ]);

        $response->assertStatus(200);
    }
}
