<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    
    use RefreshDatabase;

    /**
     * 
     *
     * @test
     */
    public function all_required_fields_to_signup()
    {
        $response = $this->post('/api/v1/auth/signup', []);

        $response
        ->assertStatus(400);
    }

    /**
     * 
     * @test
     */
    public function email_must_be_valid_to_signup()
    {

        $response = $this->post('/api/v1/auth/signup', [
            'firstName' => 'john',
            'lastName' => 'doe',
            'email' => 'john.doe',
            'password' => 'password1234',
            'password_confirmation' => 'password1234'
        ]);

        $response
        ->assertStatus(400);
    }

    /**
     * 
     * @test
     */
    public function passwords_must_to_signup()
    {

        $response = $this->post('/api/v1/auth/signup', [
            'firstName' => 'john',
            'lastName' => 'doe',
            'email' => 'john.doe@example.com',
            'password' => 'password1234',
            'password_confirmation' => 'password123'
        ]);

        $response
        ->assertStatus(400);
    }



}
