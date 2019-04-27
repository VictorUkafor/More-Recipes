<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     */
    public function can_signup_user()
    {
        
        $response = $this->json('POST', '/api/v1/auth/signup', [
            'firstName' => 'john', 
            'lastName' => 'doe',
            'email' => 'johndoe1004@gmail.com', 
            'password' => 'password1234', 
            'password_confirmation' => 'password1234'
            ]);
            
        $response->assertStatus(201);
    }
}
