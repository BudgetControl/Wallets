<?php
namespace Budgetcontrol\Wallet\Domain\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    'created_at',
    'updated_at',
    'deleted_at'
    ];

    public function __construct()
    {
        if(!isset($this->attributes['uuid'])) {
            $this->attributes['uuid'] = \Ramsey\Uuid\Uuid::uuid4()->toString();
        }
        parent::__construct($this->attributes);
    }

    public function setClosingDateAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('d-m-Y 00:00:00') : null;
    }

    public function setInvoiceDateAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('d-m-Y 00:00:00') : null;
    }
}