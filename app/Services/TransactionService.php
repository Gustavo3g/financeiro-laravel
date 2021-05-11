<?php


namespace App\Services;


use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    protected $objWallet;
    protected $objTransaction;
    protected $verify;

    public function __construct(Wallet $wallet, VerifyService $verifyService, Transaction $transaction)
    {
        $this->objWallet = $wallet;
        $this->objTransaction = $transaction;
        $this->verify = $verifyService;

    }


    public function transactionExecute($dataTransaction)
    {

        try {
            $payerWallet = $this->objWallet->where('user_id', $dataTransaction->payer)
                ->first(); // pagador
            $payeeWallet = $this->objWallet->where('user_id', $dataTransaction->payee)
                ->first(); // beneficiario
            $value = $dataTransaction->value; // valor da transação


            DB::beginTransaction();

            $transactionData = [
                'value' => $value,
                'receiver_id' => $dataTransaction->payee,
                'sender_id' => $dataTransaction->payer
            ];
            $newValuePayer = $payerWallet->balance - $value;
            $newValuePayee = $payeeWallet->balance + $value;

            $updatedPayer = $this->objWallet->find($dataTransaction->payer)->update([
                'balance' => $newValuePayer,
            ]);
            $updatedPayee = $this->objWallet->find($dataTransaction->payee)->update([
                'balance' => $newValuePayee,
            ]);
            $this->objTransaction->create($transactionData);


            if (!$updatedPayee && !$updatedPayer)
            {
                DB::rollBack();
                return true;
            }

            DB::commit();
            return true;

        } catch (\Exception $e){
            return $e;
        }
    }
}
