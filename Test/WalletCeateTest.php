<?php

namespace Budgetcontrol\Test;

use Slim\Psr7\Stream;
use MLAB\PHPITest\Service\HttpRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Budgetcontrol\Wallet\Domain\Model\Wallet;
use Budgetcontrol\Entry\Domain\Enum\EntryType;
use Budgetcontrol\Wallet\Http\Controller\WalletController;
use GuzzleHttp\Psr7\Utils;

class WalletCeateTest extends BaseCase
{

    const ASSSERTION = [
            "name" => "",
            "color" => "",
            "invoice_date" => "",
            "closing_date" => "",
            "payment_account" => null,
            "type" => "",
            "installement_value" => null,
            "currency" => null,
            "balance" => null,
            "exclude_from_stats" => null,
            'uuid' => '',
            'workspace_id' => null,
            'updated_at' => '',
            'created_at' => '',
            'id' => null
    ];

    public function testCreateCreditCardRevolginType()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $argv = ['wsid' => 1];

        $bodyParams = [
            "name" => "test",
            "color" => "#e6e632ff",
            "invoice_date" => "2024-07-11 13:45:00",
            "closing_date" => "2024-07-04 13:45:00",
            "payment_account" => 1,
            "type" => "credit-card-revolving",
            "installement_value" => 400,
            "currency" => 2,
            "balance" => 0,
            "exclude_from_stats" => false
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $resultBody);

        $this->assertEquals($bodyParams, $resultBody);
       
    }

    public function testCreateCreditCardType()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $argv = ['wsid' => 1];

        $bodyParams = [
            "name" => "test",
            "color" => "#e6e632ff",
            "invoice_date" => "2024-07-11 13:45:00",
            "closing_date" => "2024-07-04 13:45:00",
            "payment_account" => 1,
            "type" => "credit-card",
            "currency" => 2,
            "balance" => 0,
            "exclude_from_stats" => false
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $resultBody);

        $this->assertEquals($bodyParams, $resultBody);
       
    }

    public function testCreateBankType()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $argv = ['wsid' => 1];

        $bodyParams = [
            "name" => "test",
            "color" => "#e6e632ff",
            "payment_account" => 1,
            "type" => "bank",
            "currency" => 2,
            "balance" => 0,
            "exclude_from_stats" => false
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $resultBody);

        $this->assertEquals($bodyParams, $resultBody);
       
    }

    public function testCreateCacheType()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $argv = ['wsid' => 1];

        $bodyParams = [
            "name" => "test",
            "color" => "#e6e632ff",
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
        $resultBody = (array) json_decode((string) $result->getBody());
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $resultBody);

        $this->assertEquals($bodyParams, $resultBody);
       
    }

    public function testCreateLoanType()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $argv = ['wsid' => 1];

        $bodyParams = [
            "name" => "test",
            "color" => "#e6e632ff",
            "payment_account" => 1,
            "type" => "loan",
            "currency" => 2,
            "balance" => 0,
            "exclude_from_stats" => false
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $resultBody);

        $this->assertEquals($bodyParams, $resultBody);
       
    }

    public function testInvestmentType()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $argv = ['wsid' => 1];

        $bodyParams = [
            "name" => "test",
            "color" => "#e6e632ff",
            "payment_account" => 1,
            "type" => "investment",
            "currency" => 2,
            "balance" => 0,
            "exclude_from_stats" => true
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $resultBody);

        $this->assertEquals($bodyParams, $resultBody);
       
    }

    public function testPrepaidCardType()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $argv = ['wsid' => 1];

        $bodyParams = [
            "name" => "test",
            "color" => "#e6e632ff",
            "payment_account" => 1,
            "type" => "prepaid-card",
            "currency" => 2,
            "balance" => 0,
            "exclude_from_stats" => false
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $resultBody);

        $this->assertEquals($bodyParams, $resultBody);
       
    }

    public function testOtherType()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $argv = ['wsid' => 1];

        $bodyParams = [
            "name" => "test",
            "color" => "#e6e632ff",
            "payment_account" => 1,
            "type" => "other",
            "currency" => 2,
            "balance" => 0,
            "exclude_from_stats" => false
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $resultBody);

        $this->assertEquals($bodyParams, $resultBody);
       
    }
}