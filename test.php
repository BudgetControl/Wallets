<?php

require_once __DIR__ . '/bootstrap/app.php';

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