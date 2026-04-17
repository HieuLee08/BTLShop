@extends('admin_layout') {{-- Thay bằng tên layout admin của bạn --}}
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">Quản lý Danh mục (Cha & Con)</div>
        
        <div class="row w3-res-tb">
            @if(Session::has('message'))
                <span style="color:green">{{ Session::get('message') }}</span>
                {{ Session::put('message', null) }}
            @endif

            <form action="{{URL::to('/save-category-product')}}" method="post" style="padding: 20px;">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Tên danh mục</label>
                    <input type="text" name="catName" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Thuộc danh mục</label>
                    <select name="parent_id" class="form-control">
                        <option value="0">--- Là danh mục cha ---</option>
                        @foreach($parent_cate as $pcate)
                            <option value="{{$pcate->catId}}">{{$pcate->catName}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Hiển thị</label>
                    <select name="type" class="form-control">
                        <option value="1">Có</option>
                        <option value="0">Không</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-info">Thêm ngay</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên danh mục</th>
                        <th>Cấp bậc</th>
                        <th>Hiển thị</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_cate as $cate)
                    <tr>
                        <td>{{ $cate->catName }}</td>
                        <td>
                            @if($cate->parent_id == 0)
                                <b style="color:blue">Danh mục cha</b>
                            @else
                                @php
                                    $parent = DB::table('tbl_category')->where('catId', $cate->parent_id)->first();
                                    echo "-- Con của: " . ($parent->catName ?? 'N/A');
                                @endphp
                            @endif
                        </td>
                        <td>{{ $cate->type == 1 ? 'Có' : 'Không' }}</td>
                        <td>
                            <a onclick="return confirm('Xóa nhé?')" href="{{URL::to('/delete-category/'.$cate->catId)}}" class="active" ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i> Xóa
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection