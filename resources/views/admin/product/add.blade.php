@extends('admin.admin_layout')
@section('admin_content')
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm Sản Phẩm Mới</h2>
        <div class="block">
            @if(session('message')) 
                <span class="success">{{ session('message') }}</span> 
            @endif
            
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <table class="form">
                    <tr>
                        <td>Tên sản phẩm</td>
                        <td><input type="text" name="proName" class="medium" required /></td>
                    </tr>
                    
                    <tr>
                        <td>Danh mục</td>
                        <td>
                            <select name="catId">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->catId }}">{{ $cat->catName ?? 'Danh mục ' . $cat->catId }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Nhà cung cấp</td>
                        <td>
                            <select name="nccId">
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->nccId }}">{{ $brand->nccName }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Tác giả</td>
                        <td>
                            <select name="tacgiaId">
                                @foreach($authors as $author)
                                    <option value="{{ $author->tacgiaId }}">{{ $author->tacgiaName }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Giá sản phẩm</td>
                        <td><input type="number" name="proPrice" class="medium" required /></td>
                    </tr>
                    
                    <tr>
                        <td>Mô tả (Nội dung)</td>
                        <td><textarea name="proContent" class="medium" rows="5"></textarea></td>
                    </tr>
                    
                   
<tr>
    <td>Hình ảnh chính</td>
    <td><input type="file" name="proImage" required /></td>
</tr>

<tr>
    <td>Ảnh chi tiết (Ảnh nhỏ)</td>
    <td><input type="file" name="piImage[]" multiple /></td>
</tr>
                    <tr>
                        <td>Giảm giá (Sale)</td>
                        <td><input type="number" name="proSale" class="medium" value="0" /></td>
                    </tr>

                    <tr>
                        <td>Sách mới (New Book)</td>
                        <td>
                            <select name="proNewBook">
                                <option value="1">Có</option>
                                <option value="0">Không</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Sản phẩm nổi bật</td>
                        <td>
                            <select name="proFeatured">
                                <option value="1">Có</option>
                                <option value="0">Không</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Lưu Sản Phẩm" /></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection