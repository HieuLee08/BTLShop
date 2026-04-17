@extends('frontend.layout.app')

@section('content')
<section class="content mt-25">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="mb-2">Kết quả tìm kiếm</h3>
                <p class="text-muted">Từ khóa: <strong>{{ $keyword }}</strong></p>
            </div>
        </div>

        @if($products->count() > 0)
            <div class="row">
                @foreach($products as $p)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="product-item border p-3 shadow-sm bg-white" style="border-radius: 8px;">
                            <a href="{{ route('product.detail', $p->proId) }}" class="text-decoration-none text-dark">
                                <div class="product-img mb-3" style="width: 100%; height: 220px; overflow: hidden; border-radius: 7px;">
                                    <img src="{{ asset('uploads/product/'.$p->proImage) }}" alt="{{ $p->proName }}" style="width:100%; height:100%; object-fit:cover;">
                                </div>
                                <h5 class="fs-6 mb-2 text-truncate" title="{{ $p->proName }}">{{ $p->proName }}</h5>
                            </a>

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                @if($p->proSale > 0)
                                    @php $price = $p->proPrice - ($p->proPrice * $p->proSale / 100); @endphp
                                    <span class="text-danger fw-bold">{{ number_format($price) }}₫</span>
                                    <small class="text-decoration-line-through text-muted">{{ number_format($p->proPrice) }}₫</small>
                                @else
                                    <span class="fw-bold">{{ number_format($p->proPrice) }}₫</span>
                                @endif
                            </div>

                            <a href="{{ route('product.detail', $p->proId) }}" class="btn btn-primary btn-sm w-100">Xem chi tiết</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning">Không tìm thấy sản phẩm phù hợp với từ khóa '{{ $keyword }}'. Vui lòng thử lại với từ khóa khác.</div>
        @endif
    </div>
</section>
@endsection
