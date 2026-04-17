<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Slider
        $sliders = Slider::where('slActive', 1)->get();
        
        // 2. Lấy TẤT CẢ category (để View tự dùng logic phân cấp Cha - Con)
        $categories = Category::all();

        // 3. Product theo category (Chỉ lấy theo Danh Mục Cha để hiển thị thành từng khối to ngoài trang chủ)
        // Nếu bạn muốn hiện cả khối của danh mục con thì đổi 'parent_id', 0 thành all() nhé.
        $parentCategories = Category::where('parent_id', 0)->get();
        $productsByCategory = [];
        foreach ($parentCategories as $cat) {
            $productsByCategory[$cat->catName] = Product::where('catId', $cat->catId)->limit(8)->get();
        }

        // 4. Sách mới
        $newBooks = Product::where('proNewBook', 1)->limit(5)->get();

        return view('frontend.home', compact(
            'sliders',
            'categories',
            'productsByCategory',
            'newBooks'
        ));
    }
}