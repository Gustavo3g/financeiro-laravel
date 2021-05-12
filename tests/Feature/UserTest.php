<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;
    /**
     * Criação de um usuario
     *
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

    /**
     * Verifica se o nome completo foi passado
     *
     */
    public function test_required_fullName()
    {
        $data_payload = [
            'cpf'        => '99999999998',
            'email'      => 'exemple1@exemple.com',
            'password'   => '123456',
            'shopkeeper' => 0
        ];

        $this->postJson('/api/users', $data_payload)
            ->assertStatus(422)
            ->assertJson(
                [
                    'message' => 'full_name is required.'
                ]
            );
    }
    /**
     * Verifica se o email foi passado
     *
     */
    public function test_required_email()
    {
        $data_payload = [
            'full_name' => $this->faker->name,
            'cpf'        => '99999999998',
            'password'   => '123456',
            'shopkeeper' => 0
        ];

        $this->postJson('/api/users', $data_payload)
            ->assertStatus(422)
            ->assertJson(
                [
                    'message' => 'email is required.'
                ]
            );
    }

    /**
     * Verifica se o cpf foi passado
     *
     */
    public function test_required_cpf()
    {
        $data_payload = [
            'full_name' => $this->faker->name,
            'email'        => 'test@test.com',
            'password'   => '123456',
            'shopkeeper' => 0
        ];

        $this->postJson('/api/users', $data_payload)
            ->assertStatus(422)
            ->assertJson(
                [
                    'message' => 'cpf is required.'
                ]
            );
    }
}
