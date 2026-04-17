<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::all();
        return view('admin.author.index', compact('authors'));
    }

    public function store(Request $request) {
        Author::create($request->all());
        return redirect()->back()->with('message', 'Thêm tác giả thành công!');
    }

    public function delete($id) {
        Author::where('tacgiaId', $id)->delete();
        return redirect()->back()->with('message', 'Xóa thành công!');
    }
}