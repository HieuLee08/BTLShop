@extends('frontend.layout.app')

@section('content')

<section class="content mt-25 productDetail-page">
    <div class="container">
        <div class="row">

            <div class="col-lg-9">

                <div class="row">

                    <div class="col-lg-6">
                        <div class="main-image mb-3">
                            <img style="width:100%; max-height:450px; object-fit:contain; border: 1px solid #eee;"
                                 src="{{ asset('uploads/product/'.$product->proImage) }}" id="big-img">
                        </div>

                        @if($images->count() > 0)
                            <div class="product-gallery d-flex flex-wrap gap-2">
                                <img src="{{ asset('uploads/product/'.$product->proImage) }}" 
                                     style="width:70px; height:70px; object-fit:cover; border:1px solid #ddd; cursor:pointer;"
                                     onclick="document.getElementById('big-img').src=this.src">

                                @foreach($images as $img)
                                    <img src="{{ asset('uploads/product/'.$img->piImage) }}" 
                                         style="width:70px; height:70px; object-fit:cover; border:1px solid #ddd; cursor:pointer;"
                                         onclick="document.getElementById('big-img').src=this.src"
                                         class="thumb-img">
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6">
                        <h2 style="font-weight: bold;">{{ $product->proName }}</h2>
                        <p class="text-muted">Mã sản phẩm (MSP): <b>{{ $product->proId }}</b></p>

                        <p>
                            <b>Danh mục:</b> 
                            <span class="badge bg-info text-dark">{{ $product->category->catName ?? 'Đang cập nhật' }}</span>
                        </p>

                        <div class="price-box mb-3">
                            @if($product->proSale > 0)
                                @php
                                    $price = $product->proPrice - ($product->proPrice * $product->proSale / 100);
                                @endphp
                                <h3 class="text-danger d-inline">{{ number_format($price, 0, ',', '.') }}₫</h3>
                                <del class="ms-2 text-secondary">{{ number_format($product->proPrice, 0, ',', '.') }}₫</del>
                                <span class="badge bg-danger"> -{{ $product->proSale }}% </span>
                            @else
                                <h3 class="text-danger">{{ number_format($product->proPrice, 0, ',', '.') }}₫</h3>
                            @endif
                        </div>

                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->proId }}">
                            <input type="hidden" name="proName" value="{{ $product->proName }}">
                            <input type="hidden" name="proImage" value="{{ $product->proImage }}">
                            <input type="hidden" name="proPrice" value="{{ $product->proPrice }}">
                            <input type="hidden" name="proSale" value="{{ $product->proSale }}">

                            <div class="d-flex align-items-center gap-3 mb-3">
                                <label>Số lượng:</label>
                                <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 80px;">
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ
                                </button>
                                <button type="submit" class="btn btn-dark btn-lg px-4">
                                    Mua ngay
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="mt-5 pt-3 border-top">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active fw-bold" data-bs-toggle="tab">GIỚI THIỆU SÁCH</button>
                        </li>
                    </ul>
                    <div class="tab-content p-3 border border-top-0">
                        <p><b>{{ $product->proName }}</b></p>
                        <div class="description-content">
                            {!! $product->proContent !!}
                        </div>

                        <h5 class="mt-4 fw-bold">Thông tin chi tiết:</h5>
                        <table class="table table-bordered mt-2" style="max-width: 500px;">
                            <tr>
                                <td class="bg-light" width="150">Nhà cung cấp</td>
                                <td>{{ $product->brand->nccName ?? 'Đang cập nhật' }}</td>
                            </tr>
                            <tr>
                                <td class="bg-light">Tác giả</td>
                                <td>{{ $product->author->tacgiaName ?? 'Đang cập nhật' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>

            <div class="col-lg-3">
                <div class="sidebar-item mb-4">
                    <h5 class="fw-bold border-bottom pb-2">SẢN PHẨM NỔI BẬT</h5>
                    @foreach($featured as $p)
                    <div class="d-flex gap-2 mb-3 align-items-center">
                        <a href="{{ route('product.detail', $p->proId) }}">
                            <img width="70" height="70" style="object-fit: cover; border: 1px solid #eee"
                                 src="{{ asset('uploads/product/'.$p->proImage) }}">
                        </a>
                        <div class="small">
                            <a href="{{ route('product.detail', $p->proId) }}" class="text-decoration-none text-dark d-block text-truncate" style="max-width: 150px;">
                                {{ $p->proName }}
                            </a>
                            <b class="text-danger">{{ number_format($p->proPrice, 0, ',', '.') }}₫</b>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="sidebar-item">
                    <h5 class="fw-bold border-bottom pb-2">SẢN PHẨM LIÊN QUAN</h5>
                    @foreach($related as $p)
                    <div class="d-flex gap-2 mb-3 align-items-center">
                        <a href="{{ route('product.detail', $p->proId) }}">
                            <img width="70" height="70" style="object-fit: cover; border: 1px solid #eee"
                                 src="{{ asset('uploads/product/'.$p->proImage) }}">
                        </a>
                        <div class="small">
                            <a href="{{ route('product.detail', $p->proId) }}" class="text-decoration-none text-dark d-block text-truncate" style="max-width: 150px;">
                                {{ $p->proName }}
                            </a>
                            <b class="text-danger">{{ number_format($p->proPrice, 0, ',', '.') }}₫</b>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

@endsection