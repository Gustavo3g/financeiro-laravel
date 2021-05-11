<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RollbackTransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(["prefix" => "/users"],
    function () {
        Route::get('', [UserController::class, 'list']);
        Route::post('', [UserController::class, 'register']);
    }
);

Route::group(["prefix" => "/transaction"],
    function (){
        Route::post('', [TransactionController::class, 'transaction']);
    }
);

Route::group(["prefix" => "/rollback-transaction"],
    function (){
        Route::post('', [RollbackTransactionController::class, 'rollbackTransaction']);
    }
);
