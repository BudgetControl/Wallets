<?php

use Budgetcontrol\Wallet\Http\Controller\WalletController;

/**
 *  application apps
 */

$app->get('/{wsid}/list', [WalletController::class, 'index']);
$app->post('/{wsid}/create', [WalletController::class, 'store']);
$app->get('/{wsid}/show/{uuid}', [WalletController::class, 'show']);
$app->put('/{wsid}/update/{uuid}', [WalletController::class, 'update']);
$app->delete('/{wsid}/{uuid}', [WalletController::class, 'destroy']);

$app->patch('/{wsid}/restore/{uuid}', [WalletController::class, 'restore']);
$app->patch('/{wsid}/archive/{uuid}', [WalletController::class, 'archive']);
$app->patch('/{wsid}/sorting/{uuid}', [WalletController::class, 'sorting']);

$app->get('/monitor', [WalletController::class, 'monitor']);