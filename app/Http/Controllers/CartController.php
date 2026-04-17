<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 1. Hiển thị trang giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('frontend.cart', compact('cart'));
    }

    // 2. Thêm sản phẩm vào giỏ (Session)
    public function add(Request $request)
    {
        $id = $request->product_id;
        $cart = session()->get('cart', []);

        // Tính giá thực tế (sau khi giảm giá)
        $price = $request->proPrice;
        if ($request->proSale > 0) {
            $price = $price - ($price * $request->proSale / 100);
        }

        // Nếu sản phẩm đã có trong giỏ, tăng số lượng
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity;
        } else {
            // Nếu chưa có, thêm mới
            $cart[$id] = [
                "name" => $request->proName,
                "quantity" => $request->quantity,
                "price" => $price,
                "image" => $request->proImage
            ];
        }

        session()->put('cart', $cart);

        if ($request->ajax() || $request->wantsJson() || $request->isJson() || $request->header('Accept') === 'application/json') {
            return response()->json([
                'message' => 'Đã thêm vào giỏ hàng!',
                'count' => count($cart),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Đã thêm vào giỏ hàng!');
    }

    // 3. Cập nhật số lượng bằng AJAX
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cập nhật giỏ hàng thành công');
        }
    }

    // 4. Xóa sản phẩm khỏi giỏ bằng AJAX
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Đã xóa sản phẩm');
        }
    }

    // 5. Hiển thị trang thanh toán
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống. Vui lòng thêm sản phẩm trước khi thanh toán.');
        }

        $total = 0;
        foreach ($cart as $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return view('frontend.checkout', compact('cart', 'total'));
    }

    // 6. Xử lý đặt hàng và thanh toán
    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'payment_method' => 'required|in:cod,bank,momo',
            'note' => 'nullable|string|max:500',
        ], [
            'name.required' => 'Vui lòng nhập tên.',
            'email.required' => 'Vui lòng nhập email.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $total = 0;
        foreach ($cart as $details) {
            $total += $details['price'] * $details['quantity'];
        }

        $paymentMethods = [
            'cod' => 'Thanh toán khi nhận hàng (COD)',
            'bank' => 'Chuyển khoản ngân hàng',
            'momo' => 'Ví MoMo',
        ];

        // ========== LƯU VÀO DATABASE ==========
        try {
            // 1. Lấy customer ID (nếu login) hoặc 0 (guest)
            $cusId = Auth::check() ? Auth::id() : 0;

            // 2. Tạo Transaction
            $transaction = Transaction::create([
                'cusId' => $cusId,
                'tstTotalMoney' => $total,
                'tstNote' => $request->note ?? ''
            ]);

            // 3. Tính tổng số lượng sản phẩm
            $totalQuantity = 0;
            foreach ($cart as $item) {
                $totalQuantity += $item['quantity'];
            }

            // 4. Tạo Order (Inbox)
            $order_data = Order::create([
                'tstId' => $transaction->tstId,
                'cusId' => $cusId,
                'ibDate' => now(),
                'ibQuantity' => $totalQuantity,
                'ibPrice' => $total,
                'cusName' => $request->name,
                'cusAddress' => $request->address,
                'cusPhone' => $request->phone,
                'ibStatus' => 'pending'
            ]);

            // 5. Tạo Order Details
            foreach ($cart as $proId => $details) {
                OrderDetail::create([
                    'proId' => $proId,
                    'odQuantity' => $details['quantity'],
                    'cusId' => $cusId,
                    'ibId' => $order_data->ibId
                ]);
            }

            $order = [
                'order_number' => 'DHI'.$order_data->ibId,
                'customer_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'note' => $request->note,
                'payment_method' => $paymentMethods[$request->payment_method] ?? $request->payment_method,
                'items' => $cart,
                'total' => $total,
                'created_at' => now()->format('d/m/Y H:i'),
            ];
        } catch (\Exception $e) {
            return redirect()->route('checkout.index')->with('error', 'Có lỗi khi lưu đơn hàng: '.$e->getMessage());
        }

        session()->forget('cart');

        return redirect()->route('checkout.success')->with('order', $order);
    }

    // 7. Trang xác nhận đặt hàng
    public function success()
    {
        $order = session('order');
        if (!$order) {
            return redirect()->route('home')->with('error', 'Không tìm thấy đơn hàng đã đặt.');
        }

        return view('frontend.checkout-success', compact('order'));
    }
}