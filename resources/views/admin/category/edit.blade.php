@extends('admin.admin_layout')
@section('admin_content')
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa danh mục</h2>
        <div class="block copyblock">
            @foreach($edit_category as $key => $edit_value)
            <form action="{{ route('category.update', $edit_value->catId) }}" method="post">
                @csrf
                <table class="form">                    
                    <tr>
                        <td><label>Tên danh mục</label></td>
                        <td><input type="text" value="{{ $edit_value->catName }}" name="catName" class="medium" required/></td>
                    </tr>
                    <tr>
                        <td><label>Hiển thị</label></td>
                        <td>
                            <select id="select" name="type" required>
                                <option value="1" {{ $edit_value->type == 1 ? 'selected' : '' }}>Có</option>
                                <option value="0" {{ $edit_value->type == 0 ? 'selected' : '' }}>Không</option>
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td><input type="submit" name="submit" Value="Cập nhật" /></td>
                    </tr>
                </table>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection