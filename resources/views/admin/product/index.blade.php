@extends('admin.admin_layout')
@section('admin_content')
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách Sản phẩm</h2>
        <div class="block">
            @if(session('message')) 
                <span class="success">{{ session('message') }}</span> 
            @endif
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th>Nổi bật</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $pro)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        
                        <td>{{ $pro->proName }}</td>
                        
                        <td>
                            @if($pro->proImage)
                                <img src="{{ asset('uploads/product/'.$pro->proImage) }}" width="50" height="50">
                            @else
                                <span>Chưa có ảnh</span>
                            @endif
                        </td>
                        
                        <td>{{ number_format($pro->proPrice, 0, ',', '.') }} VNĐ</td>
                        
                        <td>{{ $pro->proFeatured == 1 ? 'Có' : 'Không' }}</td>
                        
                        <td>
                            <a href="{{ route('product.edit', $pro->proId) }}">Sửa</a> | <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" href="{{ route('product.delete', $pro->proId) }}">Xóa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection