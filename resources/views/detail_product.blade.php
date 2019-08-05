@extends('base')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/detail_product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/customer/categories_list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/customer/products_list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/libraries/owl.carousel.min.css') }}">
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
            <div class="product">
                <div class="col-md-6 col-sm-6 col-xs-12 image-product float-left">
                    <img src="{{ asset('images/products/' . $product->image_product) }}" width="100%" id="image-show">
                    <div class="more-images mt-2">
                        <script src="{{ asset('js/libraries/owl.carousel.min.js') }}"></script>
                        <div id="owl-demo" class="owl-carousel owl-theme">
                            <div class="item">
                                <img src="{{ asset('images/products/' . $product->image_product) }}" width="100%">
                            </div>
                            @foreach($product->images as $image)
                            <div class="item">
                                <img src="{{ asset('images/products/' . $image->image_url) }}" alt="The Last of us" width="100%">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 description-product float-left">
                    <div class="product-title"><h1>{{ $product->name }}</h1></div>
                    <div class="product-code mt-3">MÃ SỐ SẢN PHẨM : MS0010</div>
                    <div class="product-price mt-2">{{ number_format($product->price) }}₫</div>
                    <div class="product-quantity mt-4">
                        <span>SỐ LƯỢNG: </span>
                        <input type="number" min="1" class="quantity ml-1" value="1" id="quantity">
                    </div>
                    <div class="product-description mt-3">
                        <span>{{ $product->description }}</span>
                    </div>

                    <div class="add-to-cart mt-3">
                        <div class="btn btn-lg btn-success" onclick="addCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ $product->image_product }}')">Thêm vào giỏ hàng</div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="product-detail mt-4">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active bg-white" id="nav-home-tab">Chi tiết sản phẩm</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-product-detail">
                        {!! $product->detail !!}
                    </div>
                </div>
            </div>
            <div class="mt-5"></div>
            {{--box product--}}
            <div class="box-products">
                <h2 class="title-box">
                    <span>Sản phẩm liên quan</span>
                </h2>
{{--                <a href="#" class="view-all">Xem tất cả</a>--}}
            </div>
            <div class="products">
                @foreach($moreProducts as $product)
                    <div class="product col-lg-3 col-md-3 col-sm-6 col-xs-6 float-left">
                        <div class="item">
                            <div class="image">
                                <img src="{{ asset('images/products/' . $product->image_product) }}">
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
    <script>
        $(document).ready(function() {
            $("#owl-demo").owlCarousel({
                slideSpeed : 300,
                paginationSpeed : 400,
                singleItem:true,
                items : 3,
                dots: true,
                autoplay: true,
                nav: true,
                navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
            });
        });
    </script>

    <script>
        $('.owl-carousel .item').click(function () {
            var src_img = $(this).children().attr('src');
            $('#image-show').attr('src', src_img);
        });





        function addCart(product_id, name, price, img) {
            var quantity = $('#quantity').val();
            var image_url = $('#image-show').attr('src');
            $.ajax({
                url: window.location.origin + '/carts/',
                method: 'POST',
                data: {
                    product_id: product_id,
                    name: name,
                    price: price,
                    quantity: quantity,
                    image_url: image_url
                },
                success: function(data) {
                    console.log(data)
                    $('#cart-' + data.rowId).hide();
                    var html = `<div class="cart-content mt-3" id="cart-${data.rowId}">
						<div class="cart-product-image float-left col-md-3">
							<img src="${data.options.image_url}" width="100%">
						</div>
						<div class="float-left col-md-9 mb-3">
							<div class="float-left">
								<a href="#">${data.name} (${data.qty})</a>
								<div> x ${data.price} đ</div>
							</div>
							<div class="float-right"><i class="fa fa-trash remove-item-cart" aria-hidden="true" onclick="deleteCart(${data.id}, '${data.rowId}')"></i></div>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>`;
                    $('#shopping-cart-list').prepend(html)
                    $('#quantity').val(0)
                    $('.qty').text(data.count)
                    $('#subtotal').text(data.subtotal);
                    alertify.success('Thêm vào giỏ hàng thành công')
                },
                error: function(errors) {
                    if(errors.status == 422) {
                        if (errors.responseJSON.errors.product_id) {
                            alertify.error(errors.responseJSON.errors.product_id[0]);
                        }
                        if (errors.responseJSON.errors.name) {
                            alertify.error(errors.responseJSON.errors.name[0]);
                        }
                        if (errors.responseJSON.errors.quantity) {
                            alertify.error(errors.responseJSON.errors.quantity[0]);
                        }
                        if (errors.responseJSON.errors.price) {
                            alertify.error(errors.responseJSON.errors.price[0]);
                        }
                        if (errors.responseJSON.errors.image_url) {
                            alertify.error(errors.responseJSON.errors.image_url[0]);
                        }
                    }
                }
            })
        }
    </script>
@endsection
