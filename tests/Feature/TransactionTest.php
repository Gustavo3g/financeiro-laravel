<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_transaction()
    {
        $data_payload = [
            'value' => '19',
            'payer' => '2',
            'payee' => '1',
        ];

        $this->postJson('/api/transaction', $data_payload)
            ->assertStatus(200);
    }
}
