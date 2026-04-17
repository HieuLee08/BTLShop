<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'tbl_inbox';
    protected $primaryKey = 'ibId';
    public $timestamps = false;

    protected $fillable = [
        'tstId',
        'cusId',
        'ibDate',
        'ibQuantity',
        'ibPrice',
        'cusName',
        'cusAddress',
        'cusPhone',
        'ibStatus'
    ];

    // Quan hệ với Customer
    public function customer()
    {
        return $this->belongsTo(User::class, 'cusId', 'id');
    }

    // Quan hệ với Transaction
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'tstId', 'tstId');
    }

    // Quan hệ với chi tiết đơn hàng
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'ibId', 'ibId');
    }
}
