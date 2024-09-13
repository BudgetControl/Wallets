<?php

require_once __DIR__ . '/bootstrap/app.php';

use Budgetcontrol\Library\Model\User;
use Illuminate\Database\Capsule\Manager as DB;
use Budgetcontrol\Wallet\Facade\Crypt;

$wallets = \Budgetcontrol\Library\Model\Wallet::all();
foreach ($wallets as $wallet) {
    echo $wallet->name . PHP_EOL;

    $walletName = Crypt::encrypt($wallet->name);
    
    DB::table('wallets')
        ->where('id', $wallet->id)
        ->update(['name' => $walletName]);

}

$users = User::all();
foreach ($users as $user) {
    echo $user->name . PHP_EOL;

    $userName = Crypt::encrypt($user->name);
    
    DB::table('users')
        ->where('id', $user->id)
        ->update(['name' => $userName]);

}