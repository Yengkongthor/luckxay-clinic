<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Log;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test register.
     *
     * @return void
     */
    public function testRegister()
    {
        $phone = '+8562077986371';
        $name = $this->faker()->name();
        $surname = $this->faker()->lastName();

        $firebaseServiceUser = collect([
            'uid' => 'tlHgAbdDLwZ9nggorD3DqLOkZzS7',
            'providerData' => [
                [
                    'uid' => $phone,
                    'providerId' => 'phone',
                ]
            ]

        ]);

        $response = $this->postJson('/api/v1/register-test?key=vVKvdY5wolcbPdDRWlQvwddgEeOSMlE5', [
            'name' => $name,
            'surname' => $surname,
            'phone' => $phone,
            'password' => '123456',
            'device_info' => 'mac',
            'token' => 'token',
            'firebaseServiceUser' => $firebaseServiceUser,
        ]);

        $response
            ->assertJson([
                'data' => [
                    'phone' => $phone,
                ]
            ]);
    }
}
