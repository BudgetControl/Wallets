<?php

use Budgetcontrol\Wallet\Domain\Model\Wallet;
use Phinx\Seed\AbstractSeed;

class WalletSeeds extends AbstractSeed
{

    public function run(): void
    {
        $wallets = [
            [
                "name" => "test",
                "color" => "#e6e632ff",
                "invoice_date" => "2024-07-11 13:45:00",
                "closing_date" => "2024-07-04 13:45:00",
                "payment_account" => 1,
                "type" => "credit-card-revolving",
                "installement_value" => 400,
                "currency" => 2,
                "balance" => 0,
                "exclude_from_stats" => false,
                'uuid' => '04628d9f-eadc-498c-89df-9b846560ba6f',
                "workspace_id" => 1
            ],
            [
                "name" => "test",
                "color" => "#e6e632ff",
                "invoice_date" => "2024-07-11 13:45:00",
                "closing_date" => "2024-07-04 13:45:00",
                "payment_account" => 1,
                "type" => "credit-card",
                "installement_value" => null,
                "currency" => 2,
                "balance" => 0,
                "exclude_from_stats" => false,
                'uuid' => '3f7102f9-b5cb-4482-af46-f183a0a771b5',
                "workspace_id" => 1
            ],
            [
                "name" => "test",
                "color" => "#e6e632ff",
                "invoice_date" => null,
                "closing_date" => null,
                "payment_account" => 1,
                "type" => "bank",
                "installement_value" => null,
                "currency" => 2,
                "balance" => 0,
                "exclude_from_stats" => false,
                'uuid' => 'efe863d3-4296-4df2-91c9-714dd5128583',
                "workspace_id" => 1
            ],
            [
                "name" => "test",
                "color" => "#e6e632ff",
                "invoice_date" => null,
                "closing_date" => null,
                "payment_account" => 1,
                "type" => "cache",
                "installement_value" => null,
                "currency" => 2,
                "balance" => 0,
                "exclude_from_stats" => false,
                'uuid' => '50bb8d7f-8f64-4597-b74d-d07d6b7a646c',
                "workspace_id" => 1
            ],
            [
                "name" => "test",
                "color" => "#e6e632ff",
                "invoice_date" => null,
                "closing_date" => null,
                "payment_account" => 1,
                "type" => "investment",
                "installement_value" => null,
                "currency" => 2,
                "balance" => 0,
                "exclude_from_stats" => false,
                'uuid' => '265d2a1a-fb4d-4342-816d-f4474113fe74',
                "workspace_id" => 1
            ],
            [
                "name" => "test",
                "color" => "#e6e632ff",
                "invoice_date" => null,
                "closing_date" => null,
                "payment_account" => 1,
                "type" => "loan",
                "installement_value" => null,
                "currency" => 2,
                "balance" => 0,
                "exclude_from_stats" => false,
                'uuid' => '650d0e89-224b-4247-9698-46f5aaf8bc64',
                "workspace_id" => 1
            ],
            [
                "name" => "test",
                "color" => "#e6e632ff",
                "invoice_date" => null,
                "closing_date" => null,
                "payment_account" => 1,
                "type" => "other",
                "installement_value" => null,
                "currency" => 2,
                "balance" => 0,
                "exclude_from_stats" => false,
                'uuid' => '17aa68f4-afff-4073-8264-58e3a6ea0147',
                "workspace_id" => 1
            ],
            [
                "name" => "test",
                "color" => "#e6e632ff",
                "invoice_date" => null,
                "closing_date" => null,
                "payment_account" => 1,
                "type" => "prepaid-card",
                "installement_value" => null,
                "currency" => 2,
                "balance" => 0,
                "exclude_from_stats" => false,
                'uuid' => '2127070f-63a4-4334-8c3b-9939ba4bb090',
                "workspace_id" => 1
            ],
        ];

        foreach ($wallets as $wallet) {
            Wallet::create($wallet);
        }
    }
}
