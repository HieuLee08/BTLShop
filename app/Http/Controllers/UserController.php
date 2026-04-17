<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Gọi giao diện Đăng nhập / Đăng ký
    public function login() {
        return view('frontend.login'); 
    }

    public function register() {
        return view('frontend.register'); // Chú ý: Trả về đúng view đăng ký nếu bạn tách file
    }

    // Xử lý lưu tài khoản mới (Vấn đề 3: Đã sửa lỗi thiếu trường phone, address)
    public function postRegister(Request $request) {
        // Kiểm tra email trùng lặp
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->with('error_register', 'Email này đã được sử dụng!');
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); 
        
        // Gán giá trị mặc định tránh lỗi Database
        $user->phone = $request->phone ?? ''; 
        $user->address = $request->address ?? '';
        
        $user->save();

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Hãy đăng nhập.');
    }

    // Xử lý kiểm tra Đăng nhập
    public function postLogin(Request $request) {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password 
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/'); 
        } else {
            return redirect()->back()->with('error_login', 'Sai email hoặc mật khẩu!');
        }
    }

    // Đăng xuất
    public function logout() {
        Auth::logout();
        return redirect('/');
    }

    // Gọi giao diện Profile
    public function profile() {
        return view('frontend.profile'); 
    }

    // Xử lý Cập nhật thông tin Profile
    // Xử lý Cập nhật thông tin
    public function updateProfile(Request $request) {
        
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone ?? '';
        $user->address = $request->address ?? '';

        $user->save(); 

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công!');
    }
}