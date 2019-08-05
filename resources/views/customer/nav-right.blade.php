<link rel="stylesheet" href="{{ asset('css/customer/nav-right.css') }}">

<div class="nav-right">
    <div class="right-box pb-3 mb-5">
        <div class="title">HỖ TRỢ TRỰC TUYẾN</div>
        <div class="content mt-3">
            <div class="icon col-2 float-left"><i class="fa fa-phone-square" aria-hidden="true"></i></div>
            <div class="contact col-10 float-right">
                <div class="contact-title">Tư vấn bán hàng 1</div>
                <div>{{ $spCompany->phone }}</div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="content mt-3">
            <div class="icon col-2 float-left"><i class="fa fa-envelope" aria-hidden="true"></i></div>
            <div class="contact col-10 float-right">
                <div class="contact-title">Tư vấn bán hàng 1</div>
                <div>{{ $spCompany->email }}</div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="right-box mb-5 list">
        <div class="title">SẢN PHẨM BÁN CHẠY</div>
        @foreach($hotProducts as $product)
        <div class="product pb-3 mt-3 mb-2 pr-2">
            <div class="product-image float-left">
                <img src="{{ asset('images/products/' . $product->image_product) }}" width="100%">
            </div>
            <div class="describe float-right pt-2">
                <a href="{{ route('frontend.products.show', ['id' => $product->id, 'slug' => $product->slug]) }}" class="name">{{ $product->name }}</a>
                <div class="price mt-1">{{ number_format($product->price) }}₫</div>
            </div>
            <div class="clearfix"></div>
        </div>
        @endforeach
    </div>

    <div class="right-box mb-5 list">
        <div class="title">TIN TỨC</div>
        @foreach($spNewsLatest as $news)
            <div class="news pb-3 mt-3 mb-2 pr-2">
                <div class="product-image float-left">
                    <img src="{{ asset('images/news/' . $news->image) }}" width="100%">
                </div>
                <div class="describe float-right pt-2">
                    <a href="#" class="mt-1 font-weight-bold text-dark">{{ $news->title }}</a>
                </div>
                <div class="clearfix"></div>
            </div>
        @endforeach
    </div>
</div>
