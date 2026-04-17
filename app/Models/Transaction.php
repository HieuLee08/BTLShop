<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'tbl_transactions';
    protected $primaryKey = 'tstId';
    public $timestamps = false;

    protected $fillable = [
        'cusId',
        'tstTotalMoney',
        'tstNote'
    ];

    // Quan hệ với Customer
    public function customer()
    {
        return $this->belongsTo(User::class, 'cusId', 'id');
    }

    // Quan hệ với Order
    public function orders()
    {
        return $this->hasMany(Order::class, 'tstId', 'tstId');
    }
}
