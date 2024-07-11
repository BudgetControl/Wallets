<?php
namespace Budgetcontrol\Wallet\Http\Controller;

use Budgetcontrol\Wallet\Domain\Enums\Wallet;
use Budgetcontrol\Wallet\Domain\Model\Workspace;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Budgetcontrol\Wallet\Exceptions\NotValidWalletException;

class Controller {

    public function monitor(Request $request, Response $response)
    {
        return response([
            'success' => true,
            'message' => 'Stats service is up and running'
        ]);
        
    }

    protected function validate(array $data): void
    {
        if(!in_array($data['type'], Wallet::types()) ) {
            throw new NotValidWalletException('Invalid wallet type');
        }

        // if credit card type, must have installement and installement_value
        if($data['type'] === Wallet::CREDIT_CARD || $data['type'] === Wallet::CREDIT_CARD_REVOLVING) {
            if(!isset($data['installement'])) {
                throw new NotValidWalletException('Credit card must have installement and installement_value');
            }

            if(!isset($data['payment_account'])) {
                throw new NotValidWalletException('Credit card must have payment_account');
            }

            if(!isset($data['closing_date'])) {
                throw new NotValidWalletException('Credit card must have closing_date');
            }

            if(!isset($data['invoice_date'])) {
                throw new NotValidWalletException('Credit card must have invoice_date');
            }
        }

        // if credit card revolving, installement_value
        if($data['type'] === Wallet::CREDIT_CARD_REVOLVING) {
            if(!isset($data['installement_value'])) {
                throw new NotValidWalletException('Credit card revolving must have installement_value');
            }
        }
    }
}