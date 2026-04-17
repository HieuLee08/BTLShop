<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function category(){
    return $this->belongsTo(Category::class,'catId');
}

public function brand(){
    return $this->belongsTo(Brand::class,'nccId');
}

public function author(){
    return $this->belongsTo(Author::class,'tacgiaId');
}
}
