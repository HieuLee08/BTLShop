@extends('frontend.layout.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card shadow-sm rounded-4 overflow-hidden border-0">
                <div class="row g-0">
                    <div class="col-md-4 bg-primary text-white p-4 d-flex flex-column align-items-center justify-content-center">
                        <div class="profile-avatar mb-3">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                        <h4 class="mb-1 fw-bold">{{ Auth::user()->name }}</h4>
                        <p class="mb-3 text-white-75">Khách hàng Dahita Books</p>
                        <div class="profile-badge">Thành viên</div>
                    </div>
                    <div class="col-md-8 p-4">
                        <div class="mb-4">
                            <h3 class="mb-1">Tài khoản của bạn</h3>
                            <p class="text-muted mb-0">Cập nhật thông tin để nhận ưu đãi và theo dõi đơn hàng nhanh hơn.</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success shadow-sm">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Họ và tên</label>
                                <input type="text" class="form-control form-control-lg" name="name" value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control form-control-lg" name="email" value="{{ Auth::user()->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Số điện thoại</label>
                                <input type="text" class="form-control form-control-lg" name="phone" value="{{ Auth::user()->phone }}" placeholder="Nhập số điện thoại">
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Địa chỉ</label>
                                <input type="text" class="form-control form-control-lg" name="address" value="{{ Auth::user()->address }}" placeholder="Nhập địa chỉ giao hàng">
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">Cập nhật thông tin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('css')
<style>
    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 42px;
        font-weight: 700;
        color: #ffffff;
        box-shadow: inset 0 0 0 1px rgba(255,255,255,0.12);
    }
    .profile-badge {
        background: rgba(255,255,255,0.15);
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 0.9rem;
        letter-spacing: 0.03em;
    }
    .form-control-lg {
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.05);
    }
    .card {
        border-radius: 24px;
    }
</style>
@endpush

{{-- Đoạn JS cũ của bạn giữ nguyên --}}
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
@endsection