@extends('admin.admin_layout')

@section('admin_content')
<div class="grid_10">
    <div class="box">
        <div class="box-head">
            <h2 class="left">Quản lý đơn hàng</h2>
        </div>
        <div class="box-content">
            @if (session('success'))
                <div style="background-color: #28a745; color: white; padding: 10px; margin-bottom: 15px; border-radius: 3px;">
                    {{ session('success') }}
                </div>
            @endif

            <table class="display">
                <thead>
                    <tr class="odd gradeX">
                        <th class="center">#</th>
                        <th class="center">ID</th>
                        <th>Khách hàng</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Ngày đặt</th>
                        <th class="center">Tổng tiền</th>
                        <th class="center">Trạng thái</th>
                        <th class="center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $key => $order)
                        <tr class="odd gradeX">
                            <td class="center">{{ $key + 1 }}</td>
                            <td class="center"><strong>{{ $order->ibId }}</strong></td>
                            <td>{{ $order->cusName }}</td>
                            <td class="center">{{ $order->cusPhone }}</td>
                            <td>{{ substr($order->cusAddress, 0, 30) }}...</td>
                            <td>{{ \Carbon\Carbon::parse($order->ibDate)->format('d/m/Y') }}</td>
                            <td class="center"><strong>{{ number_format($order->ibPrice) }}đ</strong></td>
                            <td class="center">
                                @php
                                    $statusClass = match($order->ibStatus) {
                                        'pending' => 'style="color: #ff6600;"',
                                        'approved' => 'style="color: #28a745;"',
                                        'rejected' => 'style="color: #dc3545;"',
                                        'cancelled' => 'style="color: #6c757d;"',
                                        'delivered' => 'style="color: #007bff;"',
                                        default => ''
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
                                <strong {!! $statusClass !!}>{{ $statusText }}</strong>
                            </td>
                            <td class="center" style="white-space: nowrap;">
                                <a href="{{ route('orders.show', $order->ibId) }}" class="btn-icon" title="Xem chi tiết">👁️</a>
                                
                                @if ($order->ibStatus === 'pending')
                                    <form action="{{ route('orders.approve', $order->ibId) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-icon" title="Phê duyệt" onclick="return confirm('Phê duyệt đơn hàng này?')">✓</button>
                                    </form>

                                    <form action="{{ route('orders.reject', $order->ibId) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-icon" title="Từ chối" onclick="return confirm('Từ chối đơn hàng này?')">✕</button>
                                    </form>
                                @endif

                                @if ($order->ibStatus === 'approved')
                                    <form action="{{ route('orders.delivered', $order->ibId) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-icon" title="Giao xong" onclick="return confirm('Xác nhận đã giao?')">📦</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align: center; padding: 20px; color: #999;">Không có đơn hàng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .btn-icon {
        background: none;
        border: none;
        margin: 0 3px;
        cursor: pointer;
        font-size: 16px;
        padding: 2px 5px;
    }
    .btn-icon:hover {
        opacity: 0.7;
    }
</style>
@endsection
