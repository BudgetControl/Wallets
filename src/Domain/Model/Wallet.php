<?php
namespace Budgetcontrol\Wallet\Domain\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Budgetcontrol\Library\Model\Wallet as ModelWallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use BudgetcontrolLibs\Crypt\Traits\Crypt;

class Wallet extends ModelWallet
{
    use SoftDeletes, HasFactory, Crypt;
    
    protected $table = 'wallets';

    public function name(): Attribute
    {
        $this->key = env('APP_KEY');
        
        return Attribute::make(
            get: fn (string $value) => $this->decrypt($value),
            set: fn (string $value) => $this->encrypt($value),
        );
    }
}