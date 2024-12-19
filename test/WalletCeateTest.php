<?php

namespace Budgetcontrol\Test;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Budgetcontrol\Wallet\Http\Controller\WalletController;
use Illuminate\Database\Capsule\Manager as DB;
use Carbon\Carbon;

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
            'id' => null,
            "archived" => false
    ];

    public function testCreateCreditCardRevolginType()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $argv = ['wsid' => 1];

        $bodyParams = [
            "name" => "test",
            "color" => "#e6e632ff",
            "invoice_date" => Carbon::parse(date("Y-m-d 00:00:00"))->toAtomString(),
            "closing_date" => Carbon::parse(date("Y-m-d 00:00:00"))->addMonth()->toAtomString(),
            "payment_account" => 1,
            "type" => "credit-card-revolving",
            "installement_value" => 400,
            "installement" => 1,
            "currency" => 2,
            "balance" => 0,
            "exclude_from_stats" => false,
            'installement_value' => 400.00,
            'sorting' => null,
            'credit_limit' => null,
            'voucher_value' => null
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id', 'closing_date', 'invoice_date'], $resultBody);
        $bodyParams = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id', 'closing_date', 'invoice_date'], $bodyParams);

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
            "invoice_date" => Carbon::parse(date("Y-m-d 00:00:00"))->toAtomString(),
            "closing_date" => Carbon::parse(date("Y-m-d 00:00:00"))->addMonth()->toAtomString(),
            "payment_account" => 1,
            "type" => "credit-card",
            "installement" => 1,
            "currency" => 2,
            "balance" => 0,
            "exclude_from_stats" => false,
            'installement_value' => null,
            'sorting' => null,
            'credit_limit' => null,
            'voucher_value' => null,
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id', 'closing_date', 'invoice_date'], $resultBody);
        $bodyParams = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id', 'closing_date', 'invoice_date'], $bodyParams);

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
            "exclude_from_stats" => false,
            'installement_value' => null,
            'closing_date' => null,
            'invoice_date' => null,
            'installement' => null,
            'sorting' => null,
            'credit_limit' => null,
            'voucher_value' => null,
            'installement_value' => null
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $resultBody);
        $bodyParams = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $bodyParams);

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
            "exclude_from_stats" => false,
            'closing_date' => null,
            'invoice_date' => null,
            'installement' => null,
            'sorting' => null,
            'credit_limit' => null,
            'voucher_value' => null,
            'installement_value' => null
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $resultBody);
        $bodyParams = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $bodyParams);

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
            "exclude_from_stats" => false,
            'closing_date' => null,
            'invoice_date' => null,
            'installement' => null,
            'sorting' => null,
            'credit_limit' => null,
            'voucher_value' => null,
            'installement_value' => null
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $resultBody);
        $bodyParams = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $bodyParams);

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
            "exclude_from_stats" => true,
            'closing_date' => null,
            'invoice_date' => null,
            'installement' => null,
            'sorting' => null,
            'credit_limit' => null,
            'voucher_value' => null,
            'installement_value' => null
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $resultBody);
        $bodyParams = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $bodyParams);

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
            "exclude_from_stats" => false,
            'closing_date' => null,
            'invoice_date' => null,
            'installement' => null,
            'sorting' => null,
            'credit_limit' => null,
            'voucher_value' => null,
            'installement_value' => null
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $resultBody);
        $bodyParams = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $bodyParams);

        $this->assertEquals($bodyParams, $resultBody);
       
    }

    public function testCreateVoucherType()
    {
        $_balance= new \stdClass();
        $_balance->value_in_valut = 50;
        $_balance->value_in_voucher = 10;

        $_assertions = [
            "name" => "wallet",
            "color" => "#e6e632ff",
            "type" => "voucher",
            "installement" => null,
            "installement_value" => null,
            "credit_limit" => null,
            "currency" => 2,
            "balance" => $_balance,
            "exclude_from_stats" => false,
            "invoice_date" => null,
            "payment_account" => null,
            "closing_date" => null,
            "sorting" => null,
            "workspace_id" => 1,
            "created_at" => "2024-10-18T12:39:03.000000Z",
            "updated_at" => "2024-10-18T12:41:32.000000Z",
            "voucher_value" => 5,
            "archived" => false,
        ];

        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $argv = ['wsid' => 1];

        $bodyParams = [
            "name" => "wallet",
            "color" => "#e6e632ff",
            "type" => "voucher",
            "installement" => null,
            "installement_value" => null,
            "credit_limit" => null,
            "invoice_date" => null,
            "payment_account" => null,
            "closing_date" => null,
            "currency" => 2,
            "balance" => 10,
            "exclude_from_stats" => false,
            "voucher_value" => 5
        ];

        $request->method('getParsedBody')->willReturn($bodyParams);

        $controller = new WalletController();
        $result = $controller->store($request, $response, $argv);

        $this->assertEquals(201, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id', 'closing_date', 'invoice_date'], $resultBody);
        $_assertions = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id', 'closing_date', 'invoice_date'], $_assertions);

        $this->assertEquals($_assertions, $resultBody);
       
    }

}