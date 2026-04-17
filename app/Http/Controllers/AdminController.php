<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Thêm hàm này vào:
    public function index() {
        return view('admin.dashboard');
    }
}