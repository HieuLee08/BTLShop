<div class="grid_2">
    <div class="box sidemenu">
        <div class="block" id="section-menu">
            <ul class="section menu">
                {{-- Quản lý Sản phẩm --}}
                <li><a class="menuitem">QL Sản phẩm</a>
                    <ul class="submenu">
                        <li><a href="{{ route('product.add') }}">Thêm sản phẩm mới</a></li>
                        <li><a href="{{ route('product.index') }}">Danh sách sản phẩm</a></li>
                        <li><a href="#">Danh sách giảm giá</a></li>
                    </ul>
                </li>

                {{-- Quản lý Danh mục --}}
                <li><a class="menuitem">QL Danh mục</a>
                    <ul class="submenu">
                        {{-- Cả 2 cái này đều trỏ về CategoryController@index --}}
                        <li><a href="{{ route('category.index') }}">Danh mục chính</a></li>
                        <li><a href="{{ route('category.index') }}">Danh mục con</a></li>
                        
                        <li><a href="{{ route('author.index') }}">Tác giả</a></li>
                        <li><a href="{{ route('brand.index') }}">Nhà cung cấp</a></li>
                    </ul>
                </li>

                {{-- Quản lý Slider --}}
                <li><a class="menuitem">Quản lý Slide</a>
                    <ul class="submenu">
                        {{-- Trỏ về SliderController --}}
                        <li><a href="{{ route('slider.index') }}">Danh sách slide</a></li>
                    </ul>
                </li>

                {{-- Quản lý Đơn hàng --}}
                <li><a class="menuitem">QL Đơn hàng</a>
                    <ul class="submenu">
                        <li><a href="{{ route('orders.index') }}">Danh sách đơn hàng</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>