<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RollbackTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_rollback()
    {
        $data_payload = [
            'id_transaction' => 1,
        ];

        $this->postJson('/api/rollback-transaction', $data_payload)
            ->assertStatus(200);
    }
}
