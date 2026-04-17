@extends('frontend.layout.app') @section('content')
<div class="layoutPage-cart" id="layout-cart">
    <div class="wrapper-cart-detail">
        <div class="container mt-4">
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if(session('cart'))
                <div class="heading-page">
                    <div class="header-page">
                        <h1>Giỏ hàng của bạn</h1>
                        <p class="count-cart">Có <span>{{ count(session('cart')) }} sản phẩm</span> trong giỏ hàng</p>
                    </div>
                </div>

                <div class="row wrapbox-content-cart">
                    <div class="col-12 col-md-8">
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th class="image">&nbsp;</th>
                                    <th class="px-3">Tên sản phẩm</th>
                                    <th class="item">Giá</th>
                                    <th class="item">Số lượng</th>
                                    <th class="item">Thành tiền</th>
                                    <th class="remove">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach(session('cart') as $id => $details)
                                    @php 
                                        $thanhTien = $details['price'] * $details['quantity'];
                                        $total += $thanhTien; 
                                    @endphp
                                    <tr class="line-item-container" data-id="{{ $id }}">
                                        <td class="image">
                                            <img width="80" src="{{ asset('uploads/product/'.$details['image']) }}" alt="{{ $details['name'] }}">
                                        </td>
                                        <td class="item">
                                            <h3><a href="{{ route('product.detail', $id) }}">{{ $details['name'] }}</a></h3>
                                        </td>
                                        <td class="item">
                                            <span class="price">{{ number_format($details['price'], 0, ',', '.') }}₫</span>
                                        </td>
                                        <td class="qty">
                                            <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" style="width: 70px;">
                                        </td>
                                        <td class="item">
                                            <span class="line-item-total price">{{ number_format($thanhTien, 0, ',', '.') }}₫</span>
                                        </td>
                                        <td class="remove">
                                            <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash"></i> Xóa</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="sidebox-order">
                            <div class="sidebox-order-inner">
                                <h3>Thông tin đơn hàng</h3>
                                <div class="sidebox-order_total mb-3">
                                    <p>Tổng tiền: <strong class="total-price text-danger fs-4">{{ number_format($total, 0, ',', '.') }}₫</strong></p>
                                </div>
                                <div class="sidebox-order_action">
                                    @if(auth()->check())
                                        <a href="{{ route('checkout.index') }}" class="btn btn-dark w-100 mb-2">THANH TOÁN</a>
                                    @else
                                        <a href="{{ route('login') }}?redirect={{ urlencode(route('checkout.index')) }}" class="btn btn-dark w-100 mb-2">Đăng nhập để thanh toán</a>
                                        <p class="text-warning mt-2">Bạn cần đăng nhập để hoàn tất mua hàng.</p>
                                    @endif
                                    <a href="/" class="btn btn-outline-secondary w-100"><i class="fa fa-reply"></i> Tiếp tục mua hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="heading-page text-center py-5">
                    <h1>Giỏ hàng của bạn</h1>
                    <p class="count-cart">Có <span>0 sản phẩm</span> trong giỏ hàng</p>
                    <a href="/" class="btn btn-primary mt-3">Tiếp tục mua hàng</a>
                </div>
            @endif

        </div>
    </div>
</div>

<script type="text/javascript">
    // Cập nhật giỏ hàng
    document.querySelectorAll('.update-cart').forEach(function(input) {
        input.addEventListener('change', function() {
            let row = this.closest('tr');
            let id = row.getAttribute('data-id');
            let quantity = this.value;

            fetch('{{ route('cart.update') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: id, quantity: quantity })
            }).then(() => window.location.reload());
        });
    });

    // Xóa khỏi giỏ hàng
    document.querySelectorAll('.remove-from-cart').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            if(confirm("Bạn có chắc muốn xóa sản phẩm này?")) {
                let row = this.closest('tr');
                let id = row.getAttribute('data-id');

                fetch('{{ route('cart.remove') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: id })
                }).then(() => window.location.reload());
            }
        });
    });
</script>
@endsection