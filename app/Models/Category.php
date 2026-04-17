<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'tbl_category'; 

    protected $primaryKey = 'catId'; 

    public $timestamps = false;

    // Phải thêm parent_id vào đây thì mới lưu được danh mục con
    protected $fillable = ['catName', 'parent_id', 'type']; 
}