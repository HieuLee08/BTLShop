<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    // LIST
    public function index()
    {
        $sliders = Slider::orderBy('slId', 'desc')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    // ADD
    public function store(Request $request)
    {
        $request->validate([
            'slTitle' => 'required',
            'slLink' => 'required',
            'slImage' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'slTarget' => 'required',
            'slActive' => 'required'
        ]);

        $imageName = null;

        if ($request->hasFile('slImage')) {
            $image = $request->file('slImage');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('backend/uploads'), $imageName);
        }

        Slider::create([
            'slTitle' => $request->slTitle,
            'slLink' => $request->slLink,
            'slImage' => $imageName,
            'slActive' => $request->slActive,
            'slTarget' => $request->slTarget,
        ]);

        return back()->with('success', 'Thêm slider thành công');
    }

    // DELETE
    public function delete($id)
    {
        $slider = Slider::findOrFail($id);

        // Xóa ảnh
        $path = public_path('backend/uploads/'.$slider->slImage);
        if (file_exists($path)) {
            unlink($path);
        }

        $slider->delete();

        return back()->with('success', 'Xóa thành công');
    }
}