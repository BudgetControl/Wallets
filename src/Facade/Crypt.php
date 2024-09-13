<?php
declare(strict_types=1);

namespace Budgetcontrol\Wallet\Facade;

use Illuminate\Support\Facades\Facade;

final class Crypt extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'crypt';
    }
}