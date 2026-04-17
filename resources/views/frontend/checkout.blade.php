@extends('frontend.layout.app')

@section('content')
<div class="layoutPage-checkout" id="layout-checkout">
    <div class="container mt-4">
        <div class="heading-page mb-4">
            <div class="header-page">
                <h1>Thanh toán</h1>
                <p>Hoàn tất thông tin mua hàng và chọn phương thức thanh toán.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="mb-3">Thông tin giao hàng</h3>
                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf

                            <div class="input-group">
                                <label for="name">Họ và tên</label>
                                <input type="text" id="name" name="name" value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}">
                                @error('name')<div class="error-message">{{ $message }}</div>@enderror
                            </div>

                            <div class="input-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}">
                                @error('email')<div class="error-message">{{ $message }}</div>@enderror
                            </div>

                            <div class="input-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')<div class="error-message">{{ $message }}</div>@enderror
                            </div>

                            <div class="input-group">
                                <label for="address">Địa chỉ giao hàng</label>
                                <input type="text" id="address" name="address" value="{{ old('address') }}">
                                @error('address')<div class="error-message">{{ $message }}</div>@enderror
                            </div>

                            <div class="input-group checkout-note">
                                <label for="note">Ghi chú đơn hàng</label>
                                <textarea id="note" name="note" placeholder="Ví dụ: giao hàng giờ hành chính">{{ old('note') }}</textarea>
                                @error('note')<div class="error-message">{{ $message }}</div>@enderror
                            </div>

                            <div class="payment-method">
                                <h4>Phương thức thanh toán</h4>
                                <label class="payment-option">
                                    <input type="radio" name="payment_method" value="cod" {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }}>
                                    <span>Thanh toán khi nhận hàng (COD)</span>
                                </label>
                                <label class="payment-option mt-2">
                                    <input type="radio" name="payment_method" value="bank" {{ old('payment_method') === 'bank' ? 'checked' : '' }}>
                                    <span>Chuyển khoản ngân hàng</span>
                                </label>
                                <label class="payment-option mt-2">
                                    <input type="radio" name="payment_method" value="momo" {{ old('payment_method') === 'momo' ? 'checked' : '' }}>
                                    <span>Ví MoMo</span>
                                </label>
                                @error('payment_method')<div class="error-message">{{ $message }}</div>@enderror
                            </div>

                            <button type="submit" class="btn btn-submit mt-3">ĐẶT HÀNG</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sidebox-order">
                    <div class="sidebox-order-inner">
                        <h3>Đơn hàng của bạn</h3>
                        <div class="sidebox-order_total mb-3">
                            <p>Tổng tiền: <strong class="total-price text-danger fs-4">{{ number_format($total, 0, ',', '.') }}₫</strong></p>
                        </div>

                        <div class="sidebox-order_products">
                            @foreach($cart as $id => $details)
                                <div class="mb-3">
                                    <strong>{{ $details['name'] }}</strong>
                                    <p class="mb-1">Số lượng: {{ $details['quantity'] }}</p>
                                    <p class="mb-0">{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}₫</p>
                                </div>
                            @endforeach
                        </div>

                        <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100"><i class="fa fa-reply"></i> Tiếp tục mua hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
