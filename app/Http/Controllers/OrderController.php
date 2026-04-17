<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Danh sách tất cả đơn hàng
    public function index()
    {
        $orders = Order::with(['customer', 'details.product'])->orderBy('ibDate', 'desc')->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    // Chi tiết đơn hàng
    public function show($id)
    {
        $order = Order::with(['customer', 'details.product'])->findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    // Phê duyệt đơn hàng
    public function approve($id)
    {
        $order = Order::findOrFail($id);
        $order->ibStatus = 'approved';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được phê duyệt!');
    }

    // Từ chối đơn hàng
    public function reject($id)
    {
        $order = Order::findOrFail($id);
        $order->ibStatus = 'rejected';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã bị từ chối!');
    }

    // Hủy đơn hàng
    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        $order->ibStatus = 'cancelled';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã bị hủy!');
    }

    // Xác nhận đã giao
    public function delivered($id)
    {
        $order = Order::findOrFail($id);
        $order->ibStatus = 'delivered';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Cập nhật trạng thái giao hàng thành công!');
    }
}
