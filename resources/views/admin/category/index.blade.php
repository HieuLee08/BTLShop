@extends('admin.admin_layout')
@section('admin_content')
<div class="grid_10">
    <div class="box round first grid">
        <h2>Quản lý danh mục (Cha & Con)</h2>
        <div class="block copyblock mb-25">
            {{-- Hiển thị thông báo --}}
            @if(session('message'))
                <div style="color: green; font-weight: bold; margin-bottom: 10px;">
                    {{ session('message') }}
                </div>
            @endif
            
            <form action="{{ route('category.store') }}" method="post">
                @csrf 
                <table class="form">                    
                    <tr>
                        <td><label>Tên danh mục</label></td>
                        <td><input type="text" name="catName" placeholder="Ví dụ: Truyện tranh, Nấu ăn..." class="medium" required/></td>
                    </tr>
                    <tr>
                        <td><label>Thuộc danh mục</label></td>
                        <td>
                            <select name="parent_id" class="medium">
                                <option value="0">--- Là danh mục cha ---</option>
                                @foreach($parent_cate as $p_cat)
                                    <option value="{{ $p_cat->catId }}">{{ $p_cat->catName }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Hiển thị</label></td>
                        <td>
                            <select name="type" class="medium" required>
                                <option value="1">Có</option>
                                <option value="0">Không</option>
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td></td>
                        <td><input type="submit" name="submit" Value="Thêm mới" class="btn btn-primary" /></td>
                    </tr>
                </table>
            </form>
        </div>

        <h2>Danh sách danh mục hiện có</h2>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên danh mục</th>
                        <th>Cấp bậc</th>
                        <th>Trạng thái</th>
                        <th>Tùy chỉnh</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_category as $key => $cat)
                    <tr class="odd gradeX">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $cat->catName }}</td>
                        <td>
                            @if($cat->parent_id == 0)
                                <b style="color:blue;">[Gốc]</b>
                            @else
                                @php
                                    $parent = App\Models\Category::where('catId', $cat->parent_id)->first();
                                @endphp
                                <span style="color:green;">-- Con của: {{ $parent->catName ?? 'N/A' }}</span>
                            @endif
                        </td>
                        <td>{{ $cat->type == 1 ? 'Hiển thị' : 'Đang ẩn' }}</td>
                        <td>
                            <a href="{{ route('category.edit', $cat->catId) }}">Sửa</a> | 
                            <a onclick="return confirm('Xóa danh mục này sẽ ảnh hưởng đến sản phẩm bên trong. Bạn chắc chứ?')" 
                               href="{{ route('category.delete', $cat->catId) }}" style="color:red;">Xóa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection