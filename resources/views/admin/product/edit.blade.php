@extends('admin.admin_layout')
@section('admin_content')
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa Sản Phẩm</h2>
        <div class="block">
            @if(session('message')) 
                <span class="success">{{ session('message') }}</span> 
            @endif
            
            {{-- Đổi action trỏ về route update và truyền id sản phẩm vào --}}
            <form action="{{ route('product.update', $product->proId) }}" method="post" enctype="multipart/form-data">
                @csrf
                <table class="form">
                    <tr>
                        <td>Tên sản phẩm</td>
                        <td><input type="text" name="proName" value="{{ $product->proName }}" class="medium" required /></td>
                    </tr>
                    
                    <tr>
                        <td>Danh mục</td>
                        <td>
                            <select name="catId">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->catId }}" {{ $product->catId == $cat->catId ? 'selected' : '' }}>
                                        {{ $cat->catName ?? 'Danh mục ' . $cat->catId }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Nhà cung cấp</td>
                        <td>
                            <select name="nccId">
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->nccId }}" {{ $product->nccId == $brand->nccId ? 'selected' : '' }}>
                                        {{ $brand->nccName }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Tác giả</td>
                        <td>
                            <select name="tacgiaId">
                                @foreach($authors as $author)
                                    <option value="{{ $author->tacgiaId }}" {{ $product->tacgiaId == $author->tacgiaId ? 'selected' : '' }}>
                                        {{ $author->tacgiaName }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Giá sản phẩm</td>
                        <td><input type="number" name="proPrice" value="{{ $product->proPrice }}" class="medium" required /></td>
                    </tr>
                    
                    <tr>
                        <td>Mô tả (Nội dung)</td>
                        <td><textarea name="proContent" class="medium" rows="5">{{ $product->proContent }}</textarea></td>
                    </tr>
                    
                    <tr>
                        <td>Hình ảnh hiện tại</td>
                        <td>
                            @if($product->proImage)
                                <img src="{{ asset('uploads/product/'.$product->proImage) }}" alt="Hình sản phẩm" height="100"><br>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Chọn hình mới (nếu muốn đổi)</td>
                        <td><input type="file" name="proImage" /></td>
                    </tr>

                    <tr>
                        <td>Giảm giá (Sale)</td>
                        <td><input type="number" name="proSale" value="{{ $product->proSale }}" class="medium" /></td>
                    </tr>

                    <tr>
                        <td>Sách mới (New Book)</td>
                        <td>
                            <select name="proNewBook">
                                <option value="1" {{ $product->proNewBook == 1 ? 'selected' : '' }}>Có</option>
                                <option value="0" {{ $product->proNewBook == 0 ? 'selected' : '' }}>Không</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Sản phẩm nổi bật</td>
                        <td>
                            <select name="proFeatured">
                                <option value="1" {{ $product->proFeatured == 1 ? 'selected' : '' }}>Có</option>
                                <option value="0" {{ $product->proFeatured == 0 ? 'selected' : '' }}>Không</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Cập Nhật Sản Phẩm" /></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection