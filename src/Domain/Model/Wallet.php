<?php
namespace Budgetcontrol\Wallet\Domain\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Wallet extends Model
{
    use SoftDeletes, HasFactory;
    
    protected $table = 'wallets';

    protected $fillable = [
    'uuid',
    'name',
    'color',
    'type',
    'installement',
    'installement_value',
    'currency',
    'balance',
    'exclude_from_stats',
    'invoice_date',
    'payment_account',
    'closing_date',
    'sorting',
    'workspace_id',
    ];

    public function __construct()
    {
        if(!isset($this->attributes['uuid'])) {
            $this->attributes['uuid'] = \Ramsey\Uuid\Uuid::uuid4()->toString();
        }
        parent::__construct($this->attributes);
    }

    protected function closingDate(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => is_null($value) ? null : Carbon::parse($value)->toAtomString(),
            set: fn (?string $value) => is_null($value) ? null :  Carbon::parse($value)->format('Y-m-d')
        );
    }

    protected function invoiceDate(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => is_null($value) ? null : Carbon::parse($value)->toAtomString(),
            set: fn (?string $value) => is_null($value) ? null : Carbon::parse($value)->format('Y-m-d')
        );
    }
}