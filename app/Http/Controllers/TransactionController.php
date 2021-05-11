<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Services\TransactionService;
use App\Services\VerifyService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $verify;
    private $transactionService;
    private $wallet;

    public function __construct(VerifyService $verifyService, TransactionService $transactionService, Wallet $wallet)
    {
        $this->verify = $verifyService;
        $this->transactionService = $transactionService;
        $this->wallet = $wallet;
    }

    public function transaction(Request $requestTransaction)
    {
        try {
            $payer = $this->verify->verifyPayer($requestTransaction);
            $verify_ = $this->verify->verifyTransfer($requestTransaction);
            $verify_value = $this->verify->verifyValueTransfer($requestTransaction);

            if(!$verify_)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'User cannot transfer to himself'
                ],400);
            }

            if(!$verify_value)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Minimum for transaction is 0.01 R$'
                ],400);
            }

            if(!$payer)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'The user is not allowed to make transactions'
                ],400);
            }


                $getMock = $this->verify->getEndpoint();

                if($getMock['status'] == 200 && $getMock['body']->message == 'Autorizado') {

                    $payerWallet = $this->wallet->find($requestTransaction->payer);

                    if($payerWallet->balance < $requestTransaction->value)
                    {
                        return response()->json([
                            'success' => false,
                            'message' => 'Insufficient funds'
                        ]);
                    }

                    $executeTransaction = $this->transactionService->transactionExecute($requestTransaction);

                    if ($executeTransaction) {
                        $this->verify->getNotify();
                        return response()->json([
                            'success' => true,
                            'message' => 'Transfer successful'
                        ]);

                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Couldnt make transfer'
                        ], 500);
                    }
                }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'check the request'
            ]);
        }




    }
}
