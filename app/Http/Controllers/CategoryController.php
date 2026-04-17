<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use DB;

class CategoryController extends Controller
{
    public function index() {
        // Lấy danh mục cha (parent_id = 0)
        $parent_cate = Category::where('parent_id', 0)->get();
        
        // Lấy tất cả danh mục để hiện ở bảng bên dưới
        $all_category = Category::orderBy('catId', 'desc')->get(); 

        // Gửi chính xác tên biến 'parent_cate' sang View
        return view('admin.category.index')
            ->with('parent_cate', $parent_cate)
            ->with('all_category', $all_category);
    }

    public function store(Request $request) {
        // Kiểm tra dữ liệu đầu vào cơ bản
        $request->validate([
            'catName' => 'required',
            'type' => 'required'
        ]);

        $category = new Category();
        $category->catName = $request->catName;
        $category->parent_id = $request->parent_id ?? 0; // Nếu không chọn thì mặc định là cha (0)
        $category->type = $request->type;
        $category->save();

        return redirect()->back()->with('message', 'Thêm danh mục thành công!');
    }

    public function delete($id) {
        // Trước khi xóa cha, có thể cập nhật các con thành cha hoặc xóa luôn (tùy bạn)
        Category::where('catId', $id)->delete();
        return redirect()->back()->with('message', 'Xóa thành công!');
    }

    public function edit($id) {
        $parent_cate = Category::where('parent_id', 0)->get();
        $edit_value = Category::where('catId', $id)->first();
        
        return view('admin.category.edit')
            ->with('parent_cate', $parent_cate)
            ->with('edit_value', $edit_value);
    }

    public function update(Request $request, $id) {
        $data = $request->all();
        Category::where('catId', $id)->update([
            'catName' => $data['catName'],
            'parent_id' => $data['parent_id'],
            'type' => $data['type']
        ]);
        return redirect()->route('category.index')->with('message', 'Cập nhật thành công!');
    }
}