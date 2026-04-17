<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    // 1. Chỉ định chính xác tên bảng
    protected $table = 'tbl_products_images'; 

    // 2. Khai báo khóa chính của bảng là 'piId' (quan trọng)
    protected $primaryKey = 'piId';

    // 3. Tắt tính năng tự động cập nhật thời gian (vì bảng không có created_at/updated_at)
    public $timestamps = false; 

    // 4. (Tùy chọn) Cho phép thêm dữ liệu hàng loạt vào các cột này
    protected $fillable = ['piImage', 'proId'];
}