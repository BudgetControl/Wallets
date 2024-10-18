<?php
declare(strict_types=1);

namespace Budgetcontrol\Wallet\Http\Controller;

use Budgetcontrol\Wallet\Entity\Order;
use Budgetcontrol\Wallet\Entity\Filter;
use Budgetcontrol\Library\Entity\Wallet;
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
        if($data['type'] === Wallet::creditCard->value || $data['type'] === Wallet::creditCardRevolving->value) {
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
        if($data['type'] === Wallet::creditCardRevolving->value) {
            if(!isset($data['installement_value'])) {
                throw new NotValidWalletException('Credit card revolving must have installement_value');
            }
        }

        // if wallet is voucher validate fields
        if($data['type'] === Wallet::voucher->value) {
            if(empty($data['voucher_value'])) {
                throw new NotValidWalletException('Voucher must have voucher_value');
            }
        }
    }

    /**
     * Applies the specified order to the query.
     *
     * @param \Illuminate\Database\Eloquent\Builder &$query The query builder instance.
     * @param Order $orders The order to apply.
     * @return \Illuminate\Database\Eloquent\Builder The modified query builder instance.
     */
    public function orderBy(\Illuminate\Database\Eloquent\Builder &$query, Order $orders): \Illuminate\Database\Eloquent\Builder
    {
        if($orders->getOrder()) {
            foreach($orders->getOrder() as $key => $order) {
                $query->orderBy($key, $order);
            }
        }

        return $query;
    }

    /**
     * Apply filters to the query.
     *
     * @param \Illuminate\Database\Eloquent\Builder &$query The query builder instance.
     * @param Filter $filters The filter instance.
     * @return \Illuminate\Database\Eloquent\Builder The modified query builder instance.
     */
    protected function filters(\Illuminate\Database\Eloquent\Builder &$query, Filter $filters): \Illuminate\Database\Eloquent\Builder
    {
        foreach($filters->getFilters() as $key => $value) {
                if(isset($value['condition'])) {
                    $query->where($key, $value['condition'], $value['value']);
                }elseif(is_array($value['value'])) {
                    $query->whereIn($key, $value['value']);
                }else {
                    $query->where($key, $value['value']);
                }
        }

        return $query;
    }
}