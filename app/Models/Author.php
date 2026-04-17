<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'tbl_tacgia'; 
    protected $primaryKey = 'tacgiaId'; 
    public $timestamps = false;
    
    // Đã cấu hình chuẩn không có cột type
    protected $fillable = ['tacgiaName']; 
}