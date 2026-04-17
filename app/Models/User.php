<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // 1. Chỉ định chính xác tên bảng trong Database
    protected $table = 'tbl_customer';

    // 2. Tắt tự động lưu thời gian (created_at, updated_at)
    public $timestamps = false;

    /**
     * Các trường được phép thêm/sửa hàng loạt.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',    
        'address',  
    ];

    /**
     * Các trường cần được ẩn đi (bảo mật).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Ép kiểu dữ liệu.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}