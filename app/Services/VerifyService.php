<?php


namespace App\Services;

use App\Models\User;
use App\Models\Wallet;

class VerifyService
{
    private $objUser;
    private $objWallet;

    public function __construct(User $user, Wallet $wallet)
    {
        $this->objUser = $user;
        $this->objWallet = $wallet;
    }

    public function verify($objVerify)
    {

        $verifyMail = $this->objUser->where('email', $objVerify->email)->first();
        $verifyCpf = $this->objUser->where('cpf', $objVerify->cpf)->first();


        if( isset($verifyMail->email) || isset($verifyCpf->cpf) ){

            return false;
        }

        return true;
    }

    public function verifyValueTransfer($objVerify)
    {
        if ($objVerify->value == '0.00')
        {
            return  false;
        }

        return true;
    }

    public function verifyTransfer($objVerify)
    {

        if($objVerify->payer == $objVerify->payee){

            return false;

        }


        return true;
    }

    public function verifyPayer($dataPayer)
    {
        $payer = $this->objUser->find($dataPayer->payer);

        if($payer->shopkeeper)
        {
           return false;
        }

        return true;

    }

    function getEndpoint()
    {
        $endpont = 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6';
        $client = new \GuzzleHttp\Client();

        $res = $client->request('GET',$endpont);

        $response['status'] = $res->getStatusCode();
        $response['body'] = json_decode($res->getBody()->getContents());


        return $response;

    }
    function getNotify()
    {
        $endpont = 'http://o4d9z.mocklab.io/notify';
        $client = new \GuzzleHttp\Client();

        $res = $client->request('POST',$endpont);

    }

}
