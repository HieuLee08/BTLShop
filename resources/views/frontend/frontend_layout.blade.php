<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Dahita Books</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
</head>
<body>
    @include('customer.header') {{-- File này sẽ tạo ở bước 2 --}}

    <div class="container">
        @yield('content') {{-- Nội dung từ home.blade.php sẽ nhảy vào đây --}}
    </div>

    @include('customer.footer') {{-- File này sẽ tạo ở bước 3 --}}

    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
</body>
</html>