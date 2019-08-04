@extends('base')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/customer/categories_list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/customer/products_list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search_products.css') }}">
@endsection
@section('content')
    <div class="slide-show">
        <div class="col-md-3">
            @include('customer/categories-list-slide-show')
        </div>
    </div>

    {{--content--}}
    <div class="content mt-5">
        <div class="col-md-9 col-sm-12 col-xs-12 float-left">
            {{--box product--}}
            <div class="box-products">
                <h2 class="title-box">
                    @if(!isset($category))
                        <span>Sản phẩm: " {{ request('key', '') }} "</span>
                    @elseif(isset($category))
                        <span>Danh mục: " {{ $category->name }} "</span>
                    @endif
                </h2>
            </div>
            <div class="products">
                @if ($products->count() < 1)
                    <div class="alert alert-danger">không có sản phẩm nào</div>
                    <a href="{{ route('home') }}" class="btn btn-success">Trang chủ</a>
                @endif
                @foreach($products as $product)
                    <div class="product col-lg-3 col-md-3 col-sm-6 col-xs-6 float-left">
                        <div class="item">
                            <div class="image">
                                <img src="{{ asset('images/products/' . $product->image_product) }}" width="100%">
                            </div>
                            <div class="product-content">
                                <h3 class="title mt-4 text-truncate">
                                    <a href="{{ route('frontend.products.show', ['id' => $product->id, 'slug' => $product->slug]) }}">{{ $product->name }}</a>
                                </h3>
                                <div class="price">{{ number_format($product->price) }}₫</div>
                                <div class="add-to-cart-btn mt-2">
                                    <a href="{{ route('frontend.products.show', ['id' => $product->id, 'slug' => $product->slug]) }}" class="btn btn-success">Mua hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="clearfix"></div>
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>
            {{--end box products--}}
        </div>

        <div class="col-md-3 col-sm-12 col-xs-12 float-right">
            @include('customer/nav-right')
        </div>
        <div class="clearfix"></div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/hide_categories_menu.js') }}"></script>
@endsection
