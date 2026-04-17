<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Author;
use App\Models\ProductImage;

class ProductController extends Controller
{
    // --- PHẦN FRONTEND ---
    public function detail($id)
    {
        $product = Product::with(['category','brand','author'])->findOrFail($id);
        $images = ProductImage::where('proId', $id)->get();
        $featured = Product::where('proFeatured', 1)->limit(5)->get();
        $related = Product::where('catId', $product->catId)->where('proId', '!=', $id)->limit(5)->get();

        return view('frontend.detail', compact('product', 'images', 'featured', 'related'));
    }

    public function search(Request $request)
    {
        $keyword = trim($request->input('keyword', ''));
        $products = Product::where('proName', 'like', '%' . $keyword . '%')
            ->orderBy('proId', 'DESC')
            ->get();

        return view('frontend.search', compact('products', 'keyword'));
    }

    public function suggest(Request $request)
    {
        $keyword = trim($request->input('keyword', ''));

        if ($keyword === '') {
            return response()->json([]);
        }

        $products = Product::where('proName', 'like', '%' . $keyword . '%')
            ->orderBy('proId', 'DESC')
            ->limit(8)
            ->get(['proId', 'proName', 'proImage', 'proPrice', 'proSale']);

        return response()->json($products);
    }

    // --- PHẦN ADMIN ---
    public function index()
    {
        $products = Product::orderBy('proId', 'DESC')->get();
        return view('admin.product.index', compact('products'));
    }

    public function add()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $authors = Author::all();
        return view('admin.product.add', compact('categories', 'brands', 'authors'));
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->proName = $request->proName;
        $product->catId = $request->catId;
        $product->nccId = $request->nccId;
        $product->tacgiaId = $request->tacgiaId;
        $product->proPrice = $request->proPrice;
        $product->proContent = $request->proContent;
        $product->proSale = $request->proSale ?? 0;
        $product->proNewBook = $request->proNewBook ?? 0;
        $product->proFeatured = $request->proFeatured ?? 0;

        // XỬ LÝ UPLOAD HÌNH ẢNH CHÍNH
        if ($request->hasFile('proImage')) {
            $file = $request->file('proImage');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/product'), $filename);
            $product->proImage = $filename;
        } else {
            $product->proImage = ''; 
        }

        $product->save(); // Lưu để lấy proId

        // --- THÊM MỚI: XỬ LÝ LƯU ẢNH CHI TIẾT ---
        if ($request->hasFile('piImage')) {
            foreach ($request->file('piImage') as $file) {
                $piFilename = time() . '_' . rand(1, 999) . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/product'), $piFilename);

                ProductImage::create([
                    'piImage' => $piFilename,
                    'proId'   => $product->proId
                ]);
            }
        }

        return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit($id) 
    { 
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        $authors = Author::all();
        return view('admin.product.edit', compact('product', 'categories', 'brands', 'authors')); 
    }

    public function update(Request $request, $id) 
    { 
        $product = Product::findOrFail($id);
        $product->proName = $request->proName;
        $product->catId = $request->catId;
        $product->nccId = $request->nccId;
        $product->tacgiaId = $request->tacgiaId;
        $product->proPrice = $request->proPrice;
        $product->proContent = $request->proContent;
        $product->proSale = $request->proSale ?? 0;
        $product->proNewBook = $request->proNewBook ?? 0;
        $product->proFeatured = $request->proFeatured ?? 0;

        if ($request->hasFile('proImage')) {
            $file = $request->file('proImage');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/product'), $filename);
            $product->proImage = $filename;
        }

        $product->save();

        // --- THÊM MỚI: CẬP NHẬT THÊM ẢNH CHI TIẾT ---
        if ($request->hasFile('piImage')) {
            foreach ($request->file('piImage') as $file) {
                $piFilename = time() . '_' . rand(1, 999) . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/product'), $piFilename);

                ProductImage::create([
                    'piImage' => $piFilename,
                    'proId'   => $id
                ]);
            }
        }

        return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function delete($id) { 
        // Code xóa nếu cần
    }
}