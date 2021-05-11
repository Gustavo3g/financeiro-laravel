<?php


namespace App\Services;

use \App\Models\Wallet;
use Ramsey\Uuid\Uuid;
class CreateWalletService
{

    private $walletObj;

    public function __construct()
    {
        $this->walletObj = new Wallet();
    }

    public function createWallet(object $user_wallet)
    {

        $walletCreate = $this->walletObj->create([
            'balance' => 100.00,
            'user_id' => $user_wallet->id,
        ]);

        return $walletCreate;
    }
}
