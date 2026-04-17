@extends('frontend.layout.app') 

@section('content')
    <section class="content">
        <div class="container">
            <div class="form-account mb-30 mt-5">
                <div class="container-account {{ request()->routeIs('register') ? 'right-panel-active' : '' }}" id="container-account">
                    
                    {{-- FORM ĐĂNG KÝ --}}
                    <div class="form-container sign-up-container">
                        <form action="{{ route('postRegister') }}" method="POST">
                            @csrf
                            <h1>Đăng Ký</h1>
                            <div class="social-container">
                                <a href="#" style="font-size: 18px;" class="social facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" id="dynamic-image-gg-sign-up" class="social">
                                    <img src="{{ asset('frontend/images/ic_google_dark.png') }}" alt="Google">
                                </a>
                            </div>
                            <span>hoặc sử dụng email của bạn để đăng ký</span>
                            
                            <div class="infield">
                                <input type="text" name="name" placeholder="Họ tên" required/>
                            </div>
                            <div class="infield">
                                <input type="email" name="email" placeholder="Email" required/>
                            </div>
                            <div class="infield">
                                <input type="password" name="password" placeholder="Mật khẩu" required/>
                            </div>

                            @if(session('error_register'))
                                <div class="error-message text-danger mt-2 fw-bold">{{ session('error_register') }}</div>
                            @endif

                            <button class="button mt-3" type="submit">Đăng Ký</button>
                        </form>
                    </div>
                    
                    {{-- FORM ĐĂNG NHẬP --}}
                    <div class="form-container sign-in-container">
                        <form action="{{ route('postLogin') }}" method="POST">
                            @csrf
                            <h1>Đăng Nhập</h1>
                            <div class="social-container">
                                <a href="#" style="font-size: 18px;" class="social facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" id="dynamic-image-gg-sign-in" class="social">
                                    <img src="{{ asset('frontend/images/ic_google_dark.png') }}" alt="Google">
                                </a>
                            </div>
                            <span>hoặc sử dụng tài khoản của bạn</span>
                            
                            <div class="infield">
                                <input type="email" placeholder="Email" name="email" required>
                            </div>
                            <div class="infield">
                                <input type="password" name="password" placeholder="Mật khẩu" required/>
                            </div>

                            @if(session('error_login'))
                                <div class="error-message text-danger mt-2 fw-bold">{{ session('error_login') }}</div>
                            @endif

                            <a href="#" class="forgot">Quên mật khẩu?</a>
                            <button class="button" type="submit">Đăng Nhập</button>
                        </form>
                    </div>

                    {{-- LỚP PHỦ CHUYỂN ĐỘNG (OVERLAY) --}}
                    <div class="overlay-container" id="overlayCon">
                        <div class="overlay">
                            <div class="overlay-panel overlay-left">
                                <h1>Chào mừng!</h1>
                                <p>Để giữ liên lạc với Dahita, hãy đăng nhập bằng email của bạn</p>
                                <button type="button" id="signInBtn">Đăng Nhập</button> 
                            </div>
                            <div class="overlay-panel overlay-right">
                                <h1>Chào bạn!</h1>
                                <p>Đăng ký tài khoản của bạn và bắt đầu mua sắm cùng Dahita</p>
                                <button type="button" id="signUpBtn">Đăng Ký</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- SCRIPT HIỆU ỨNG TRƯỢT (Đã bỏ @push để đảm bảo luôn chạy) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const signUpBtn = document.getElementById('signUpBtn');
            const signInBtn = document.getElementById('signInBtn');
            const container = document.getElementById('container-account');

            if (signUpBtn && signInBtn && container) {
                signUpBtn.addEventListener('click', () => {
                    container.classList.add('right-panel-active');
                });

                signInBtn.addEventListener('click', () => {
                    container.classList.remove('right-panel-active');
                });
            }
        });
    </script>
@endsection