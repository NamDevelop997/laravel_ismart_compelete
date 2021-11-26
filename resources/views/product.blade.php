@extends('root_file')
@section('title', 'Product')
@section('content')
    <section class="products-page">
        <h2 class="text-center text-uppercase">Danh sách <span>sản phẩm</span> </h2>
        <p class="text-center">Danh sách những sản phẩm đang bán</p>
        <div class="row mt-5">
            @foreach ($products as $product)

                <div class="card col-4  border-0 product w3-animate-left">
                    <img class="card-img-top" src="{{ asset($product->thumbnail) }}" alt="">
                    <div class="card-body text-center">
                        <h4 class="card-title font-weight-bold">{{ Str::of($product->name)->limit(24) }}</h4>
                        <h6 class="card-text price mt-2 mb-2"> <sup>$</sup><span class="pr-2"><em>2000</em>
                            </span> <sup>$</sup>{{ number_format($product->price, 0, ',', '.') }}
                        </h6>
                        <a href="" class="btn btn-warning mt-2  pl-3 pr-3">Mua ngay</a>

                    </div>
                </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </section>
@endsection

{{-- @section('contact')
    @parent
@endsection --}}

{{-- @include('contact') --}}
