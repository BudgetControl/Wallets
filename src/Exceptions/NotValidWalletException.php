<?php
namespace Budgetcontrol\Wallet\Exceptions;

class NotValidWalletException extends \Exception
{
    public function __construct(string $message = '')
    {
        $message = $message ?: 'Invalid wallet type';
        parent::__construct($message, 400);
    }
}