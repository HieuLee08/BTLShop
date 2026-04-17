<section id="footer_main">
    <div style="background: linear-gradient(135deg, #71b7e6, #9b59b6); padding: 10px;"></div>

    <div class="container">
        <div class="row py-4">
            <div class="col-12 footer-right">

                <!-- LOGO -->
                <div class="footer-new mb-3">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('frontend/images/logo.png') }}" 
                             alt="Dahita Books" class="img-fluid">
                    </a>
                </div>

                <!-- TIN TỨC -->
                <div class="col-md-2 newfooter">
                    <div class="fi-title">TIN TỨC</div>
                    <ul>
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="#">Điểm sách</a></li>
                        <li><a href="#">Tuyển dụng</a></li>
                        <li><a href="#">Sự kiện</a></li>
                        <li><a href="#">Tin khuyến mại</a></li>
                    </ul>
                </div>

                <!-- HỖ TRỢ -->
                <div class="col-md-3 newfooter">
                    <div class="fi-title">Hỗ trợ khách hàng</div>
                    <ul>
                        <li><a href="#">Điều khoản sử dụng</a></li>
                        <li><a href="#">Hướng dẫn mua hàng</a></li>
                        <li><a href="#">Thanh toán</a></li>
                        <li><a href="#">Giao hàng</a></li>
                        <li><a href="#">Đổi trả</a></li>
                        <li><a href="#">Bảo mật</a></li>
                    </ul>
                </div>

                <!-- ACCOUNT -->
                <div class="col-md-3 newfooter">
                    <div class="fi-title">Thông tin</div>
                    <ul>
                        <li><a href="#">Đăng nhập</a></li>
                        <li><a href="#">Đăng ký</a></li>
                        <li><a href="#">Tra cứu đơn hàng</a></li>
                        <li><a href="#">Liên hệ</a></li>
                    </ul>
                </div>

                <!-- SOCIAL -->
                <div class="col-md-4 newfooter">
                    <div class="fi-title">Kết nối với Dahita</div>
                    <div class="row">

                        <div class="col-4">
                            <img src="{{ asset('frontend/images/logo_shopee_dark.png') }}" width="40">
                        </div>

                        <div class="col-4">
                            <i class="fab fa-facebook-f"></i>
                        </div>

                        <div class="col-4">
                            <i class="fab fa-tiktok"></i>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- JS -->
<script src="{{ asset('frontend/js/jquery.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/scroll.js') }}"></script>
<script src="{{ asset('frontend/js/button-search.js') }}"></script>
<script src="{{ asset('frontend/js/dynamic-image.js') }}"></script>