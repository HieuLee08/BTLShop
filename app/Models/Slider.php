<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'tbl_slides';
    protected $primaryKey = 'slId';
    public $timestamps = false;

    protected $fillable = [
        'slTitle',
        'slLink',
        'slImage',
        'slActive',
        'slTarget'
    ];
}