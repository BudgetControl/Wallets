<?php

namespace Budgetcontrol\Test;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Budgetcontrol\Wallet\Http\Controller\WalletController;
use Illuminate\Database\Capsule\Manager as DB;
use Carbon\Carbon;

class WalletNoErrorMethods extends BaseCase
{

    public function testCreateWithEmptyBalance()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $argv = ['wsid' => 1];

        $bodyParams = [
            "name" => "test",
            "type" => "bank",
            "amount" => 0,
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());
       
    }

}