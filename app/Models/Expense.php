<?php

namespace App\Models;

use Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'committee_id',
        'manager_id',
        'amount',
        'remarks',
    ];

    public function managerData()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'manager_id');
    }
}
