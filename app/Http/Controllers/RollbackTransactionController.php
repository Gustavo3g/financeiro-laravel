<?php

namespace App\Http\Controllers;

use App\Services\RollbackTransactionService;
use Illuminate\Http\Request;

class RollbackTransactionController extends Controller
{
    private $rollback;

    public function __construct(RollbackTransactionService $rollbackTransactionService)
    {
        $this->rollback = $rollbackTransactionService;
    }

    public function rollbackTransaction(Request $request){


        try {
            $rolbackv = $this->rollback->executeRollback($request);

            if ($rolbackv)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Transaction undone successfully'
                ]);
            }

        } catch (\Exception $e)
        {
            return response()->json([
                'success' => false,
                'message' => 'Error trying to undo transaction, check the id passed!'
            ]);
        }


    }
}
