<?php
declare(strict_types=1);

namespace Budgetcontrol\Wallet\Http\Controller;

use Ramsey\Uuid\Uuid as UuidUuid;
use Budgetcontrol\Wallet\Entity\Order;
use Budgetcontrol\Wallet\Entity\Filter;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Budgetcontrol\Library\Model\Wallet;


class WalletController extends Controller {

    /**
     * Handle the index request.
     *
     * @param Request $request The HTTP request object.
     * @param Response $response The HTTP response object.
     * @param mixed $argv Additional arguments passed to the method.
     * @return Response
     */
    public function index(Request $request, Response $response, $argv): Response
    {
        $wallets = Wallet::where('workspace_id', $argv['wsid']);

        // get filter by query params
        $filter = $request->getQueryParams()['filter'] ?? null;

        if(isset($filter['trashed']) && $filter['trashed'] == true) {
            $wallets->withTrashed();
        }

        if(!is_null(@$request->getQueryParams()['filters'])) {
            $filters = new Filter($request->getQueryParams()['filters']);
            $entries = $this->filters($wallets, $filters);
        }

        if(!is_null(@$request->getQueryParams()['order'])) {
            $order = new Order($request->getQueryParams()['order']);
            $this->orderBy($wallets, $order);
        }
        
        $wallets = $wallets->get();

        if(isset($filter['type'])) {
            $wallets = $wallets->filter(function ($wallet) use($filter) {
                return $wallet->type === $filter['type'];
            });
        }

        if(empty($wallets)) {
            return response(['message' => 'No wallets found'], 404);
        }

        return response($wallets->toArray(), 200);
    }


    /**
     * Store a new wallet.
     *
     * @param Request $request The HTTP request object.
     * @param Response $response The HTTP response object.
     * @param mixed $argv Additional arguments passed to the method.
     * @return Response
     */
    public function store(Request $request, Response $response, $argv): Response
    {
        $bodyParams = $request->getParsedBody();
        $workspaceId = $argv['wsid'];

        $this->validate($bodyParams);

        $wallet = new Wallet();
        $wallet->uuid = UuidUuid::uuid4()->toString();
        $wallet->name = $bodyParams['name'];
        $wallet->color = $bodyParams['color'];
        $wallet->type = $bodyParams['type'];
        $wallet->currency = $bodyParams['currency'];
        $wallet->exclude_from_stats = $bodyParams['exclude_from_stats'];
        $wallet->installement_value = $bodyParams['installement_value'];
        $wallet->payment_account = $bodyParams['payment_account'];
        $wallet->closing_date = $bodyParams['closing_date'];
        $wallet->invoice_date = $bodyParams['invoice_date'];
        $wallet->installement = $bodyParams['installement'];
        $wallet->sorting = $bodyParams['sorting'];
        $wallet->credit_limit = $bodyParams['credit_limit'];
        $wallet->voucher_value = $bodyParams['voucher_value'];
        $wallet->workspace_id = $workspaceId;
        $wallet->balance = $bodyParams['balance'] ?? 0;
        $wallet->save();

        return response($wallet->toArray(), 201);
    }

    /**
     * Show the wallet.
     *
     * @param Request $request The HTTP request object.
     * @param Response $response The HTTP response object.
     * @param mixed $argv Additional arguments.
     * @return Response
     */
    public function show(Request $request, Response $response, $argv): Response
    {
        $id = $argv['uuid'];
        $wallet = Wallet::where('uuid', $id)->first();
        return response($wallet->toArray(), 200);
    }

    /**
     * Update a wallet.
     *
     * @param Request $request The HTTP request object.
     * @param Response $response The HTTP response object.
     * @param mixed $argv Additional arguments passed to the controller.
     * @return Response
     */
    public function update(Request $request, Response $response, $argv): Response
    {
        $bodyParams = $request->getParsedBody();
        $this->validate($bodyParams);

        $id = $argv['uuid'];
        $wallet = Wallet::where('uuid', $id)->first();
        if(!$wallet) {
            return response(['message' => 'Wallet not found'], 404);
        }

        $wallet->fill($bodyParams);
        $wallet->save();
        return response($wallet->toArray(), 200);
    }

    /**
     * Destroy a wallet.
     *
     * @param Request $request The HTTP request object.
     * @param Response $response The HTTP response object.
     * @param mixed $argv Additional arguments passed to the controller.
     * @return Response
     */
    public function destroy(Request $request, Response $response, $argv): Response
    {
        $id = $argv['uuid'];
        $wallet = Wallet::where('uuid', $id)->first();
        if(!$wallet) {
            return response(['message' => 'Wallet not found'], 404);
        }
        $wallet->delete();

        return response(['message' => 'Wallet deleted'], 204);
    }

    /**
     * Destroy a wallet.
     *
     * @param Request $request The HTTP request object.
     * @param Response $response The HTTP response object.
     * @param mixed $argv Additional arguments passed to the controller.
     * @return Response
     */
    public function archive(Request $request, Response $response, $argv): Response
    {
        $id = $argv['uuid'];
        $wallet = Wallet::where('uuid', $id)->first();
        if(!$wallet) {
            return response(['message' => 'Wallet not found'], 404);
        }

        $wallet->archived = true;
        $wallet->save();

        return response(['message' => 'Wallet archived'], 204);
    }

    /**
     * Restores a wallet.
     *
     * @param Request $request The HTTP request object.
     * @param Response $response The HTTP response object.
     * @param mixed $argv Additional arguments passed to the controller.
     * @return Response
     */
    public function restore(Request $request, Response $response, $argv): Response
    {
        $id = $argv['uuid'];
        $wallet = Wallet::where('uuid', $id)->first();
        if(!$wallet) {
            return response(['message' => 'Wallet not found'], 404);
        }

        $wallet->archived = false;
        $wallet->save();

        return response($wallet->toArray(), 200);
    }

    /**
     * Handle the sorting of wallets.
     *
     * @param Request $request The HTTP request object.
     * @param Response $response The HTTP response object.
     * @param mixed $argv Additional arguments passed to the controller.
     * @return Response The response from the controller.
     */
    public function sorting(Request $request, Response $response, $argv): Response
    {
        $id = $argv['uuid'];
        $wallet = Wallet::where('uuid', $id)->first();
        if(!$wallet) {
            return response(['message' => 'Wallet not found'], 404);
        }

        $wallet->sorting = $request->getParsedBody()['sorting'];
        $wallet->save();

        return response($wallet->toArray(), 200);
    }

}
