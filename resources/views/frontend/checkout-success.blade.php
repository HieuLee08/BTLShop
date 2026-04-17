@extends('frontend.layout.app')

@section('content')
<div class="layoutPage-checkout-success" id="layout-checkout-success">
    <div class="container mt-4">
        <div class="heading-page mb-4">
            <div class="header-page">
                <h1>Đặt hàng thành công</h1>
                <p>Đơn hàng của bạn đã được ghi nhận. Chúng tôi sẽ xử lý và liên hệ lại sớm nhất.</p>
            </div>
        </div>

        @if(isset($order))
            <div class="card p-4 mb-4">
                <h3>Thông tin đơn hàng</h3>
                <p><strong>Mã đơn hàng:</strong> {{ $order['order_number'] }}</p>
                <p><strong>Người nhận:</strong> {{ $order['customer_name'] }}</p>
                <p><strong>Email:</strong> {{ $order['email'] }}</p>
                <p><strong>Điện thoại:</strong> {{ $order['phone'] }}</p>
                <p><strong>Địa chỉ giao hàng:</strong> {{ $order['address'] }}</p>
                <p><strong>Phương thức thanh toán:</strong> {{ $order['payment_method'] }}</p>
                @if(!empty($order['note']))
                    <p><strong>Ghi chú:</strong> {{ $order['note'] }}</p>
                @endif
                <p><strong>Tổng giá trị:</strong> {{ number_format($order['total'], 0, ',', '.') }}₫</p>
                <p><strong>Ngày đặt:</strong> {{ $order['created_at'] }}</p>

                <h4 class="mt-4">Chi tiết sản phẩm</h4>
                <ul class="list-unstyled">
                    @foreach($order['items'] as $details)
                        <li class="mb-3">
                            <strong>{{ $details['name'] }}</strong><br>
                            Số lượng: {{ $details['quantity'] }} | Thành tiền: {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}₫
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="alert alert-warning">Không tìm thấy thông tin đơn hàng.</div>
        @endif

        <a href="{{ route('home') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
    </div>
</div>
@endsection
