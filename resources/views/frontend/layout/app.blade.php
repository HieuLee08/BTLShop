<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dahita - Sách Truyện Online</title>
    
    <link rel="icon" href="{{ asset('frontend/images/ic_logo.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/owlcarousel/assets/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <script src="{{ asset('frontend/assets/vendors/jquery.min.js') }}"></script>
    
    @stack('css')
</head>
<body>

    {{-- Header --}}
    @include('frontend.layout.header')

    {{-- Nội dung thay đổi của từng trang --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('frontend.layout.footer')

    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ asset('frontend/assets/owlcarousel/owl.carousel.js') }}"></script>

    <script src="{{ asset('frontend/js/sub-menu.js') }}" defer></script>

    @stack('js')

</body>
</html>