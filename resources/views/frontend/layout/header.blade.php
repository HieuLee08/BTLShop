<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dahita - Sách Truyện Online</title>

    <link rel="icon" href="{{ asset('frontend/images/ic_logo.png') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('frontend/assets/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/owlcarousel/assets/owl.theme.default.min.css') }}">

    <script src="{{ asset('frontend/assets/vendors/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/owlcarousel/owl.carousel.js') }}"></script>
</head>

<body>

<section id="header">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-3">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('frontend/images/logo.png') }}" class="img-fluid">
                </a>
            </div>

            <div class="col-lg-6">
                <form action="{{ route('product.search') }}" method="GET">
                    <div class="row search-container">
                        <div class="col-10 position-relative">
                            <input id="search-input" type="text" name="keyword" class="input-search"
                                   placeholder="Tìm kiếm sách..." value="{{ request()->input('keyword') }}"
                                   data-suggest-url="{{ route('product.suggest') }}">
                            <div id="search-results" class="search-results d-none"></div>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="button">Tìm</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-3">
                <div class="row align-items-center">

                    <div class="col d-flex justify-content-center align-items-center">
                        <a href="{{ route('cart.index') }}" class="position-relative">
                            <i class="fa-solid fa-cart-shopping" style="font-size:22px;color:orange;"></i>
                            <span id="cart-count" class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                                {{ session('cart') ? count(session('cart')) : 0 }}
                            </span>
                        </a>
                    </div>

                    @auth
                        <div class="col-8">
                            <div class="dropdown">
                                <a class="dropdown-toggle text-decoration-none text-dark d-flex align-items-center gap-2" data-bs-toggle="dropdown" style="cursor: pointer;">
                                    <i class="fa-solid fa-user-circle" style="font-size:25px;color:orange;"></i>
                                    <span>{{ Auth::user()->cusName }}</span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @else
                        {{-- Giao diện Đăng nhập / Đăng ký mới, thẳng hàng và đẹp mắt --}}
                        <div class="col-8 d-flex justify-content-end align-items-center gap-2">
                            <a href="{{ route('login') }}" class="text-decoration-none text-dark fw-bold" style="white-space: nowrap;">Đăng nhập</a>
                            <span class="text-secondary fw-bold">|</span>
                            <a href="{{ route('register') }}" class="text-decoration-none text-dark fw-bold" style="white-space: nowrap;">Đăng ký</a>
                        </div>
                    @endauth

                </div>
            </div>

        </div>
    </div>
</section>

<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>