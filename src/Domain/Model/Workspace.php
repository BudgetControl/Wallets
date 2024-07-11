<?php
namespace Budgetcontrol\Wallet\Domain\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workspace extends Model
{
    use SoftDeletes, HasFactory;
    
    protected $table = 'workspaces';

}