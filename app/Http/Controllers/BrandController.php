<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index() {
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
    }

    public function store(Request $request) {
        Brand::create($request->all());
        return redirect()->back()->with('message', 'Thêm nhà cung cấp thành công!');
    }

    public function delete($id) {
        Brand::where('nccId', $id)->delete();
        return redirect()->back()->with('message', 'Xóa thành công!');
    }
}