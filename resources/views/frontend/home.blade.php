@extends('frontend.layout.app')

@section('content')
<section class="content mt-25">
    <div class="container">
        <div class="row flex-row-reverse">

            <div class="col-12 col-lg-9">

                <div id="home-slider" class="mb-30">
                    <div class="owl-carousel owl-theme">
                        @foreach($sliders as $slider)
                        <div class="item">
                            <a href="{{ $slider->slLink }}" target="{{ $slider->slTarget }}">
                                <img style="max-height: 426px; width:100%; object-fit:cover;"
                                     src="{{ asset('uploads/'.$slider->slImage) }}" alt="Slider">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>

                @foreach($productsByCategory as $categoryName => $products)
                {{-- Chỉ hiển thị khối danh mục nếu có sản phẩm bên trong --}}
                @if($products->count() > 0)
                <section class="home-featured-product mb-30 category-section" data-category-name="{{ $categoryName }}">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="mb-0" style="font-family: 'Montserrat', sans-serif; font-weight: 600;">{{ $categoryName }}</h3>
                        <hr class="flex-grow-1 ms-3 d-none d-md-block" style="opacity: 0.1;">
                    </div>

                    <div class="row owl-carousel owl-theme product-slider">
                        @foreach($products as $p)
                        <div class="col-12">
                            <div class="product-item border p-2 mb-3 shadow-sm bg-white" style="border-radius: 8px; transition: 0.3s;">
                                <div class="product-img position-relative overflow-hidden" style="border-radius: 5px;">
                                    @if($p->proSale > 0)
                                        <div style="position:absolute; top:5px; left:5px; background:red; color:white; padding:2px 8px; font-size: 12px; font-weight: bold; z-index: 10; border-radius: 3px;">
                                            -{{ $p->proSale }}%
                                        </div>
                                    @endif

                                    <a href="{{ route('product.detail', $p->proId) }}">
                                        <img style="width:100%; height:200px; object-fit:cover; transition: transform 0.5s;"
                                             class="hover-zoom"
                                             src="{{ asset('uploads/product/'.$p->proImage) }}">
                                    </a>
                                </div>

                                <div class="product-info mt-2 text-center">
                                    <h6 class="text-truncate px-2" title="{{ $p->proName }}">{{ $p->proName }}</h6>

                                    <div class="price-box">
                                        @if($p->proSale > 0)
                                            @php
                                                $price = $p->proPrice - ($p->proPrice * $p->proSale / 100);
                                            @endphp
                                            <span class="text-danger fw-bold">{{ number_format($price) }}₫</span>
                                            <small class="text-muted text-decoration-line-through ms-1">{{ number_format($p->proPrice) }}₫</small>
                                        @else
                                            <span class="fw-bold">{{ number_format($p->proPrice) }}₫</span>
                                        @endif
                                    </div>

                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2 w-100"
                                            onclick="addToCart(this)"
                                            data-id="{{ $p->proId }}"
                                            data-name="{{ $p->proName }}"
                                            data-price="{{ $p->proPrice }}"
                                            data-sale="{{ $p->proSale }}"
                                            data-image="{{ $p->proImage }}">
                                        <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
                @endforeach
            </div>

            <div class="col-12 col-lg-3">
                <div class="sidebar-wrapper p-3 border rounded bg-light">
                    <h5 class="mb-3 border-bottom pb-2" style="font-weight: 600;"><i class="fa-solid fa-list text-primary"></i> Danh mục</h5>
                    
                    {{-- BẮT ĐẦU SỬA MENU DANH MỤC Ở ĐÂY --}}
                    <ul class="list-unstyled">
                        @foreach($categories as $cat)
                            {{-- Chỉ hiển thị danh mục cha (parent_id = 0) ở cấp ngoài cùng --}}
                            @if($cat->parent_id == 0)
                                <li class="mb-2 category-item">
                                    <a href="#" data-category-name="{{ $cat->catName }}" class="text-decoration-none text-dark hover-link category-title" style="font-weight: bold;">
                                        <i class="fa-solid fa-chevron-right me-2" style="font-size: 10px;"></i> {{ $cat->catName }}
                                    </a>
                                    
                                    {{-- Tìm các danh mục con của danh mục cha này --}}
                                    @php
                                        $childs = $categories->where('parent_id', $cat->catId);
                                    @endphp
                                    
                                    {{-- Nếu có danh mục con thì in ra vòng lặp lồng bên trong --}}
                                    @if($childs->count() > 0)
                                        <ul class="subcategory-list">
                                            @foreach($childs as $child)
                                                <li>
                                                    <a href="{{ URL::to('/danh-muc/'.$child->catId) }}" class="text-decoration-none text-secondary hover-link subcategory-item">
                                                        {{ $child->catName }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    {{-- KẾT THÚC SỬA MENU DANH MỤC --}}

                    <h5 class="mt-4 mb-3 border-bottom pb-2" style="font-weight: 600;"><i class="fa-solid fa-fire text-danger"></i> Sách mới</h5>
                    @foreach($newBooks as $p)
                        <div class="d-flex mb-3 align-items-center bg-white p-2 rounded shadow-sm">
                            <img width="50" height="70" style="object-fit: cover; border-radius: 4px;"
                                 src="{{ asset('uploads/product/'.$p->proImage) }}">
                            <div class="ms-2">
                                <p class="mb-0 text-truncate" style="max-width: 150px; font-size: 14px;">{{ $p->proName }}</p>
                                @if($p->proSale > 0)
                                    @php $price = $p->proPrice - ($p->proPrice * $p->proSale / 100); @endphp
                                    <span class="text-danger fw-bold" style="font-size: 13px;">{{ number_format($price) }}₫</span>
                                @else
                                    <span class="fw-bold" style="font-size: 13px;">{{ number_format($p->proPrice) }}₫</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

@push('css')
<style>
    .hover-zoom:hover { transform: scale(1.1); }
    .product-item:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important; transform: translateY(-3px); }
    .hover-link:hover { color: #007bff !important; padding-left: 5px; transition: 0.3s; }
    .owl-nav button { background: rgba(0,0,0,0.5) !important; color: #fff !important; width: 30px; height: 30px; border-radius: 50% !important; }

    .category-item {
        position: relative;
        padding: 8px 0;
        transition: background 0.2s ease;
    }
    .category-item:hover {
        background: rgba(0, 123, 255, 0.05);
    }
    .category-title {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }
    .category-title .fa-chevron-right {
        transition: transform 0.2s ease;
    }
    .category-item.active-filter .category-title .fa-chevron-right {
        transform: rotate(90deg);
    }
    .subcategory-list {
        display: none;
        list-style: none;
        padding-left: 1.4rem;
        margin-top: 0.5rem;
        margin-bottom: 0;
        border-left: 2px solid rgba(0,0,0,0.08);
    }
    .category-item:hover > .subcategory-list {
        display: block;
    }
    .subcategory-item {
        display: block;
        padding: 6px 0;
        color: #6c757d;
        font-size: 0.95rem;
    }
    .subcategory-item:hover {
        color: #0d6efd !important;
    }
    .category-item.active-filter .category-title {
        color: #0d6efd !important;
        font-weight: 700;
    }
    .category-section {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    .category-section.hidden {
        opacity: 0;
        transform: translateY(20px);
        height: 0;
        overflow: hidden;
        pointer-events: none;
    }
</style>
@endpush

@push('js')
<script>
$(document).ready(function(){
    $('#home-slider .owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        dots: true,
        nav: false
    });

    $('.product-slider').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            1000: { items: 4 }
        }
    });
});

function addToCart(button) {
    const id = button.dataset.id;
    const name = button.dataset.name;
    const price = button.dataset.price;
    const sale = button.dataset.sale;
    const image = button.dataset.image;

    fetch('{{ route('cart.add') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            product_id: id,
            proName: name,
            proPrice: price,
            proSale: sale,
            proImage: image,
            quantity: 1
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.count !== undefined) {
            document.getElementById('cart-count').textContent = data.count;
        }
        alert(data.message || 'Đã thêm vào giỏ hàng');
    })
    .catch(err => {
        console.error(err);
        alert('Lỗi khi thêm vào giỏ hàng. Vui lòng thử lại.');
    });
}

// Filter product sections when clicking category titles
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.category-section');
    const categoryTitles = document.querySelectorAll('.category-title');

    categoryTitles.forEach(function(title) {
        title.addEventListener('click', function(event) {
            event.preventDefault();
            const categoryName = this.dataset.categoryName;
            const parent = this.closest('.category-item');
            const isActive = parent.classList.contains('active-filter');

            document.querySelectorAll('.category-item').forEach(function(item) {
                item.classList.remove('active-filter');
            });

            sections.forEach(function(section) {
                section.classList.add('hidden');
            });

            if (!isActive) {
                parent.classList.add('active-filter');
                sections.forEach(function(section) {
                    if (section.dataset.categoryName === categoryName) {
                        section.classList.remove('hidden');
                    }
                });
            } else {
                sections.forEach(function(section) {
                    section.classList.remove('hidden');
                });
            }
        });
    });
});
</script>
@endpush
@endsection