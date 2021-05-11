<?php


namespace App\Services;

use App\Models\User;

class CreateUserService
{
    private $objUser;
    private $objWallet;

    public function __construct()
    {
        $this->objUser = new User();

    }

    public function createUser($requestUser)
    {
        $userCreate = $this->objUser->create([
            'full_name' => $requestUser->full_name,
            'email' => $requestUser->email,
            'cpf' => $requestUser->cpf,
            'shopkeeper' => $requestUser->shopkeeper ?? 0,
            'password' => bcrypt($requestUser->password)
        ]);

        if( !$userCreate ) {
           return false;
        }

        return $this->objUser->where('email',$userCreate->email)->first();

    }

}
