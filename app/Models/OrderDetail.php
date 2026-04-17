<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'tbl_detail_inbox';
    protected $primaryKey = 'diId';
    public $timestamps = false;

    protected $fillable = [
        'proId',
        'odQuantity',
        'cusId',
        'ibId'
    ];

    // Quan hệ với Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'proId', 'proId');
    }

    // Quan hệ với Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'ibId', 'ibId');
    }
}
