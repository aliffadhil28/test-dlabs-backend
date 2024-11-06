<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Get All User Data.
     */
    public function test_get_user_data(): void
    {
        $token = JWTAuth::attempt([
            'email' => 'john.doe1@example.com',
            'password' => 'password'
        ]);
        $response = $this->get('/api/user',[
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(200);
    }

    /**
     * Add user data
     */
    public function test_add_user_data(){
        $token = JWTAuth::attempt([
            'email' => 'john.doe1@example.com',
            'password' => 'password'
        ]);

        $name = 'John Doe';
        $email = 'john.doe2@example.com';
        $password = 'password';
        $age = 32;
        $role = 'admin';
        $response = $this->post('/api/user',[
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'age' => $age,
            'role' => $role
        ],[
            'Authorization' => 'Bearer ' . $token
        ]);
        $response->assertStatus(201);
    }

    /**
     * Get user detail
     */
    public function test_get_user_detail(){
        $token = JWTAuth::attempt([
            'email' => 'john.doe1@example.com',
            'password' => 'password'
        ]);
        $id = 1;
        $response = $this->get('/api/user/'.$id,[
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(200);
    }

    /**
     * Update user data
     */
    public function test_update_user_data(){
        $token = JWTAuth::attempt([
            'email' => 'john.doe1@example.com',
            'password' => 'password'
        ]);
        $id = 1;
        $name = 'John Doe';
        $email = 'john.doe3@example.com';
        $password = 'password';
        $age = 30;
        $role = 'admin';
        $response = $this->put('/api/user/'.$id,[
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'age' => $age,
            'role' => $role
        ],[
            'Authorization' => 'Bearer ' . $token
        ]);
        $response->assertStatus(200);
    }

    /**
     * Delete user data
     */
    public function test_delete_user_data(){
        $token = JWTAuth::attempt([
            'email' => 'john.doe3@example.com',
            'password' => 'password'
        ]);

        $this->assertNotNull($token, 'JWT token was not generated, authentication failed.');

        $id = 1;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->delete('/api/user/'.$id);

        $response->assertStatus(200);
    }

}
