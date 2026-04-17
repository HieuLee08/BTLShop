<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tbl_products';
    protected $primaryKey = 'proId';
    public $timestamps = false;
public function category(){
    return $this->belongsTo(Category::class,'catId');
}

public function brand(){
    return $this->belongsTo(Brand::class,'nccId');
}

public function author(){
    return $this->belongsTo(Author::class,'tacgiaId');
}
    // Phải khai báo đủ các cột này thì dữ liệu mới không bị chặn (null)
    protected $fillable = [
        'proName', 
        'proImage', 
        'proPrice', 
        'proContent', 
        'proSale', 
        'proNewBook', 
        'proFeatured', 
        'catId', 
        'nccId', 
        'tacgiaId'
    ];
}