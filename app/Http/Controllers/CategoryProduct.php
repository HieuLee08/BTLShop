<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class CategoryProduct extends Controller
{
    // Hiển thị trang thêm và danh sách (Gom lại cho tiện như code cũ của bạn)
    public function add_category_product() {
        // Lấy danh mục cha (parent_id = 0) để đổ vào thẻ Select
        $parent_category = DB::table('tbl_category')->where('parent_id', 0)->get();
        
        // Lấy toàn bộ danh sách để hiển thị ở bảng bên dưới
        $all_category = DB::table('tbl_category')->orderBy('catId', 'desc')->get();

        return view('admin.category.add_category')
                ->with('parent_cate', $parent_category)
                ->with('all_cate', $all_category);
    }

    // Hàm lưu vào database
    public function save_category_product(Request $request) {
        $data = array();
        $data['catName'] = $request->catName;
        $data['parent_id'] = $request->parent_id;
        $data['type'] = $request->type;

        if($data['catName'] == "" || $data['type'] == "") {
            return Redirect::to('/add-category-product')->with('error', 'Không được để trống!');
        }

        DB::table('tbl_category')->insert($data);
        return Redirect::to('/add-category-product')->with('message', 'Thêm danh mục thành công!');
    }

    // Hàm xóa
    public function delete_category($catId) {
        DB::table('tbl_category')->where('catId', $catId)->delete();
        return Redirect::to('/add-category-product')->with('message', 'Xóa thành công!');
    }
}