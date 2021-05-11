<?php


namespace App\Services;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class RollbackTransactionService
{
    private $wallet;
    private $transaction;

    public function __construct(Transaction $transaction, Wallet $wallet)
    {
        $this->transaction = $transaction;
        $this->wallet = $wallet;
    }



    public function executeRollback($requestRollback)
    {
        $id_transaction = $requestRollback->id_transaction;

        $transacao_values = $this->transaction->find($id_transaction);

        $value = $transacao_values->value;
        $sender_id = $transacao_values->sender_id;
        $receiver_id = $transacao_values->receiver_id;

        $wallet_sender_values = $this->wallet->find($sender_id);
        $wallet_receiver_values = $this->wallet->find($receiver_id);

        $sender_walletNew = $wallet_sender_values->balance + $value;
        $receiver_walletNew = $wallet_receiver_values->balance - $value;

        DB::beginTransaction();

        $updateWS = $wallet_sender_values->update([
            'balance' => $sender_walletNew
        ]);
        $updateWR = $wallet_receiver_values->update([
            'balance' => $receiver_walletNew
        ]);
        $del_transaction = $this->transaction->find($id_transaction)->delete();

        if($updateWS && $updateWR && $del_transaction)
        {
            DB::commit();
            return true;
        }else {
            DB::rollBack();
            return false;
        }
    }

}
