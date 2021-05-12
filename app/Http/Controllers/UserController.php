<?php

namespace App\Http\Controllers;

use App\Helpers\ValidateHelpers;
use App\Models\User;
use App\Services\CreateUserService;
use App\Services\CreateWalletService;
use App\Services\VerifyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $objCreate;
    private $verifyService;
    private $objWallet;
    private $validate;

    public function __construct
    (CreateUserService $createUserService,
     VerifyService $verifyService,
     CreateWalletService $walletService,
    ValidateHelpers $validateHelpers)
    {
        $this->objCreate = $createUserService;
        $this->verifyService = $verifyService;
        $this->objWallet = $walletService;
        $this->validate = $validateHelpers;
    }

    public function register(Request $request) {


        try
        {
            $required = ['full_name','cpf', 'email', 'password'];

            $validate = $this->validate->required($required,$request);

            if($validate != false)
            {
                return response()->json([
                    'success' => false,
                    'message' => $validate.' is required.'
                ], 422);
            }

            DB::beginTransaction();

            $verify = $this->verifyService->verify($request);

            if(!$verify)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Informed user already exists in the system'
                ],400);
            }

            $user = $this->objCreate->createUser($request);
            $wallet = $this->objWallet->createWallet($user);

            if($user && $wallet)
            {
                DB::commit();

                return response()->json([
                    'success' => true,
                    'msg' => 'User created successfully'
                ],201);
            } else {
                DB::rollBack();

                return response()->json([
                    'success' => true,
                    'msg' => 'Unable to register user'
                ]);
            }

        } catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar Usuario'
            ],500);
        }

    }

    public function list(){

        return User::with('wallet')->get();
    }
}
