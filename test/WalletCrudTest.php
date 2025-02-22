<?php

namespace Budgetcontrol\Test;

use GuzzleHttp\Psr7\Utils;
use MLAB\PHPITest\Service\HttpRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Budgetcontrol\Wallet\Domain\Model\Wallet;
use Budgetcontrol\Entry\Domain\Enum\EntryType;
use Budgetcontrol\Wallet\Http\Controller\WalletController;
use Carbon\Carbon;

class WalletCrudTest extends BaseCase
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

    public function testIndex()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);

        $argv = ['wsid' => 1];

        $controller = new WalletController();
        $result = $controller->index($request, $response, $argv);

        $this->assertEquals(200, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        foreach (self::ASSSERTION as $key => $value) {
            $this->assertArrayHasKey($key, (array) $resultBody[0]);
        }
    }

    public function testShow()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);

        $argv = ['wsid' => 1, 'uuid' => '50bb8d7f-8f64-4597-b74d-d07d6b7a646c'];

        $wallet = Wallet::where('workspace_id', $argv['wsid'])->where('uuid', $argv['uuid'])->first();

        $controller = new WalletController();
        $result = $controller->show($request, $response, $argv);

        $this->assertEquals(200, $result->getStatusCode());
        $resultBody = (array) json_decode((string) $result->getBody());
        $this->assertEquals($wallet->toArray(), $resultBody);
    }

    public function testUpdate()
    {
        $bodyParams = [
            "name" => "test",
            "color" => "#e6e632ff",
            "invoice_date" => Carbon::parse("2024-09-01 00:00:00")->toAtomString(),
            "closing_date" => Carbon::parse(date("2024-10-01 00:00:00"))->toAtomString(),
            "payment_account" => 1,
            "type" => "credit-card-revolving",
            "installement_value" => 400.00,
            "currency" => 2,
            "balance" => 0,
            "currency" => "2",
            "balance" => 0.0,
            "exclude_from_stats" => false,
            "installement" => true,
            "sorting" => 1,
            "deleted_at" => null,
            "credit_limit" => 1000.00,
            'voucher_value' => null,
            'metafield' => null,
            'archived' => false
        ];

        $request = $this->createMock(ServerRequestInterface::class);
        $request->method('getParsedBody')->willReturn($bodyParams);

        $response = $this->createMock(ResponseInterface::class);

        $argv = ['wsid' => 1, 'uuid' => '50bb8d7f-8f64-4597-b74d-d07d6b7a646c'];

        $controller = new WalletController();
        $result = $controller->update($request, $response, $argv);

        $this->assertEquals(200, $result->getStatusCode());
        $wallet = Wallet::where('workspace_id', $argv['wsid'])->where('uuid', $argv['uuid'])->first();
        $resultBody = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $wallet->toArray());
        $bodyParams = $this->removeKeysFromAssertions(['id', 'created_at', 'updated_at', 'uuid', 'workspace_id'], $bodyParams);

        $this->assertEquals($bodyParams, $resultBody);
    }
    

    public function testArchive()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);

        $argv = ['wsid' => 1, 'uuid' => '50bb8d7f-8f64-4597-b74d-d07d6b7a646c'];

        $controller = new WalletController();
        $result = $controller->archive($request, $response, $argv);

        $walletPatched = Wallet::where('workspace_id', $argv['wsid'])->where('uuid', $argv['uuid'])->first();

        $this->assertEquals(204, $result->getStatusCode());
        $this->assertTrue($walletPatched->archived === true);
    }

    public function testRestore()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);

        $argv = ['wsid' => 1, 'uuid' => '50bb8d7f-8f64-4597-b74d-d07d6b7a646c'];

        $controller = new WalletController();
        $result = $controller->restore($request, $response, $argv);

        $walletPatched = Wallet::where('workspace_id', $argv['wsid'])->where('uuid', $argv['uuid'])->first();

        $this->assertEquals(200, $result->getStatusCode());
        $this->assertTrue($walletPatched->archived === false);
    }

    public function testDestroy()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);

        $argv = ['wsid' => 1, 'uuid' => '50bb8d7f-8f64-4597-b74d-d07d6b7a646c'];

        $controller = new WalletController();
        $result = $controller->destroy($request, $response, $argv);

        $this->assertEquals(204, $result->getStatusCode());
        $this->assertNull(Wallet::where('workspace_id', $argv['wsid'])->where('uuid', $argv['uuid'])->first());
    }

    public function assertSorting()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $request = $request->withHeader('Content-Type', 'Application/Json')
        ->withBody(Utils::streamFor(json_encode(['sorting' => 5])));

        $response = $this->createMock(ResponseInterface::class);

        $argv = ['wsid' => 1, 'uuid' => '50bb8d7f-8f64-4597-b74d-d07d6b7a646c'];

        $controller = new WalletController();
        $result = $controller->sorting($request, $response, $argv);

        $wallet = Wallet::where('workspace_id', $argv['wsid'])->where('uuid', $argv['uuid'])->first('sorting');

        $this->assertEquals(200, $result->getStatusCode());
        $this->assertTrue($wallet->sorting === 5);
    }
}
