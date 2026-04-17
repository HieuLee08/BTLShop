@extends('admin.admin_layout')

@section('admin_content')
<div class="grid_10">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Chi tiết đơn hàng #{{ $order->ibId }}</h4>
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary btn-sm float-end">Quay lại</a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5><strong>Thông tin khách hàng</strong></h5>
                            <p><strong>Tên:</strong> {{ $order->cusName }}</p>
                            <p><strong>Email:</strong> {{ $order->customer->email ?? 'N/A' }}</p>
                            <p><strong>Điện thoại:</strong> {{ $order->cusPhone }}</p>
                            <p><strong>Địa chỉ:</strong> {{ $order->cusAddress }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5><strong>Thông tin đơn hàng</strong></h5>
                            <p><strong>ID Đơn hàng:</strong> {{ $order->ibId }}</p>
                            <p><strong>Ngày đặt:</strong> {{ \Carbon\Carbon::parse($order->ibDate)->format('d/m/Y H:i') }}</p>
                            <p><strong>Tổng tiền:</strong> <span class="text-success"><strong>{{ number_format($order->ibPrice) }} đ</strong></span></p>
                            <p><strong>Số lượng sản phẩm:</strong> {{ $order->ibQuantity }}</p>
                            <p>
                                <strong>Trạng thái:</strong>
                                @php
                                    $statusClass = match($order->ibStatus) {
                                        'pending' => 'warning',
                                        'approved' => 'success',
                                        'rejected' => 'danger',
                                        'cancelled' => 'secondary',
                                        'delivered' => 'info',
                                        default => 'light'
                                    };
                                    $statusText = match($order->ibStatus) {
                                        'pending' => 'Đang chờ',
                                        'approved' => 'Đã phê duyệt',
                                        'rejected' => 'Bị từ chối',
                                        'cancelled' => 'Đã hủy',
                                        'delivered' => 'Đã giao',
                                        default => 'N/A'
                                    };
                                @endphp
                                <span class="badge bg-{{ $statusClass }}">{{ $statusText }}</span>
                            </p>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3"><strong>Chi tiết sản phẩm</strong></h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($order->details as $detail)
                                    <tr>
                                        <td>{{ $detail->product->proName ?? 'N/A' }}</td>
                                        <td>{{ $detail->odQuantity }}</td>
                                        <td>{{ $detail->product->proPrice ?? 0 }} đ</td>
                                        <td><strong>{{ ($detail->product->proPrice ?? 0) * $detail->odQuantity }} đ</strong></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Không có sản phẩm nào.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    <div class="mt-4">
                        <h5><strong>Tùy chọn hành động</strong></h5>
                        @if ($order->ibStatus === 'pending')
                            <form action="{{ route('orders.approve', $order->ibId) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check"></i> Phê duyệt đơn hàng
                                </button>
                            </form>

                            <form action="{{ route('orders.reject', $order->ibId) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn từ chối đơn hàng này?')">
                                    <i class="fas fa-times"></i> Từ chối đơn hàng
                                </button>
                            </form>
                        @elseif ($order->ibStatus === 'approved')
                            <form action="{{ route('orders.delivered', $order->ibId) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-truck"></i> Xác nhận đã giao
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                            <i class="fas fa-reply"></i> Quay lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
