<?php

use Budgetcontrol\Wallet\Domain\Model\Wallet;

class CustomWalletSeed implements \Budgetcontrol\ApplicationTests\Seeds\SeedInterface
{

    public function run(): void
    {
        Wallet::create([
                "name" => "test",
                "color" => "#e6e632ff",
                "invoice_date" => "2024-07-11 13:45:00",
                "closing_date" => "2024-07-04 13:45:00",
                "payment_account" => 1,
                "type" => "credit-card-revolving",
                "installement_value" => 400,
                "currency" => 2,
                "exclude_from_stats" => false,
                'uuid' => "testing-uuid-1",
                "workspace_id" => 1
        ]);

         Wallet::create([
                "name" => "test",
                "color" => "#e6e632ff",
                "invoice_date" => "2024-07-11 13:45:00",
                "closing_date" => "2024-07-04 13:45:00",
                "payment_account" => 1,
                "type" => "credit-card-revolving",
                "installement_value" => 400,
                "currency" => 2,
                "exclude_from_stats" => false,
                'uuid' => "50bb8d7f-8f64-4597-b74d-d07d6b7a646c",
                "workspace_id" => 1
        ]);
        
    }

    public function getDependencies(): array
    {
        return [];
    }

    public function getName(): string
    {
        return 'CustomWalletSeed';
    }

    public function shouldRun(): bool
    {
        return true;
    }

    public function getDescription(): string
    {
        return 'Custom wallet seed for testing purposes.';
    }

}
