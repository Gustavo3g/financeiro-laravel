<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_user()
    {
        $data_payload = [
            'full_name'  => $this->faker->name,
            'email'      => $this->faker->email,
            'cpf'        => $this->faker->numberBetween(11111111111, 99999999999),
            'password'   => 'senhasecreta',
            'shopkeeper' => 0
        ];

        $this->postJson('/api/users', $data_payload)
            ->assertStatus(201);
    }
}
