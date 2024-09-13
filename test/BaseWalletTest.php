<?php

namespace Budgetcontrol\Test;

use Budgetcontrol\Library\Entity\Wallet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Budgetcontrol\Wallet\Http\Controller\WalletController;
use Illuminate\Database\Capsule\Manager as DB;
use Budgetcontrol\Wallet\Facade\Crypt;

class BaseWalletTest extends BaseCase
{
    public function testFiltersType()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $argv = ['wsid' => 1];

        $queryParams = [
            'filter' => [
                'type' => Wallet::bank->value
            ]
        ];

        $request->method('getQueryParams')->willReturn($queryParams);

        $controller = new WalletController();
        $result = $controller->index($request, $response, $argv);
        $resultBody = (array) json_decode((string) $result->getBody());

        $this->assertEquals(200, $result->getStatusCode());
        foreach ($resultBody as $wallet) {
            $this->assertEquals(Wallet::bank->value, $wallet->type);
        }
       
    }

    public function testCryptedData()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $argv = ['wsid' => 1];

        $bodyParams = [
            "name" => "test wallet crypt",
            "color" => "#specificColor",
            "payment_account" => 1,
            "type" => "cache",
            "currency" => 2,
            "balance" => 0,
            "exclude_from_stats" => false
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());

        $lastEntry = DB::table('wallets')->where('color', '#specificColor')->first();
        $cryptedWalletName = Crypt::encrypt($bodyParams['name']);
        $this->assertEquals($cryptedWalletName, $lastEntry->name);

    }
}