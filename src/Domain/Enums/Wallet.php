<?php
namespace Budgetcontrol\Wallet\Domain\Enums;

enum Wallet: string {
    case BANK = 'bank';
    case CACHE = 'cache';
    case CREDIT_CARD = 'credit-card';
    case INVESTMENT = 'investment';
    case LOAN = 'loan';
    case OTHER = 'other';
    case PREPAID_CARD = 'prepaid-card';
    case CREDIT_CARD_REVOLVING = 'credit-card-revolving';

    public static function types(): array {
        return [
            self::BANK->value,
            self::CACHE->value,
            self::CREDIT_CARD->value,
            self::INVESTMENT->value,
            self::LOAN->value,
            self::OTHER->value,
            self::PREPAID_CARD->value,
            self::CREDIT_CARD_REVOLVING->value
        ];
    }
}
