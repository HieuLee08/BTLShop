<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'tbl_nhacungcap'; 
    protected $primaryKey = 'nccId'; 
    public $timestamps = false;
    
    // Chỉ để lại nccName, xóa 'type' đi
    protected $fillable = ['nccName']; 
}