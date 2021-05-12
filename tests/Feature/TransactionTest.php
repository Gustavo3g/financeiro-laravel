<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    /**
     * Transação
     *
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

    /**
     * Verifica se o valor é maior que 0.00
     *
     */
    public function test_transaction_value()
    {
        $data_payload = [
            'value' => '0.00',
            'payer' => '1',
            'payee' => '2',
        ];

        $this->postJson('/api/transaction', $data_payload)
            ->assertStatus(400)
            ->assertJson(
                [
                    'message' => 'Minimum for transaction is 0.01 R$'
                ]
            );
    }
}
