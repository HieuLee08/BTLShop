@extends('admin.admin_layout')
@section('admin_content')
<div class="grid_10">
    <div class="box round first grid">
        <h2>Quản lý Nhà cung cấp</h2>
        <div class="block">
            @if(session('message')) <span class="success">{{ session('message') }}</span> @endif
            <form action="{{ route('brand.store') }}" method="post">
                @csrf
                <table class="form">
                    <tr>
                        <td>Tên nhà cung cấp</td>
                        <td><input type="text" name="nccName" class="medium" required /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Thêm mới" /></td>
                    </tr>
                </table>
            </form>
        </div>
        
        <h2>Danh sách Nhà cung cấp</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên NCC</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brands as $key => $br)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $br->nccName }}</td>
                        <td><a onclick="return confirm('Bạn có chắc muốn xóa?')" href="{{ route('brand.delete', $br->nccId) }}">Xóa</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection