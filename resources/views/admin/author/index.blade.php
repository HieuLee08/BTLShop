@extends('admin.admin_layout')
@section('admin_content')
<div class="grid_10">
    <div class="box round first grid">
        <h2>Quản lý Tác giả</h2>
        <div class="block">
            @if(session('message')) <span class="success">{{ session('message') }}</span> @endif
            <form action="{{ route('author.store') }}" method="post">
                @csrf
                <table class="form">
                    <tr>
                        <td>Tên tác giả</td>
                        <td><input type="text" name="tacgiaName" class="medium" required /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Thêm mới" /></td>
                    </tr>
                </table>
            </form>
        </div>
        
        <h2>Danh sách Tác giả</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên tác giả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($authors as $key => $au)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $au->tacgiaName }}</td>
                        <td><a onclick="return confirm('Bạn có chắc muốn xóa?')" href="{{ route('author.delete', $au->tacgiaId) }}">Xóa</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection