{{--style--}}
<link rel="stylesheet" href="{{ asset('css/customer/header.css') }}">

<div class="header">
    <div class="col-md-3 float-left">
        <a href="{{ route('home') }}"><img src="{{ asset('storage/images/logo.png') }}" width="100%"></a>
    </div>
    <div class="col-md-5 float-left mt-4 mr-4">
        <form action="{{ route('users.search') }}">
        <div class="input-group">
            <input type="text" class="form-control search-header" placeholder="Tìm kiếm...."  name="key" value="{{ request('key', '') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-success" type="submit" id="button-addon2">Tìm kiếm</button>
            </div>
        </div>
        </form>
    </div>
    <div class="com-md-2 float-left mt-4">
        <div class="col-md-3 float-left">
            <img src="{{ asset('storage/images/mobile.png') }}">
        </div>
        <div class="col-md-9 float-left support-header">
            <span>Hỗ trợ <br>0123465789</span>
        </div>
    </div>
    <div class="col-md-2 float-left mt-4 header-cart">
        <div class="col-md-3 float-left">
            <img src="{{ asset('storage/images/cart.png') }}">
        </div>
        <div class="col-md-9 float-left mt-2">
            <a href="#"><span>Giỏ hàng <span class="text-success">(<span class="qty">{{ \Cart::content() ? \Cart::content()->count() : 0 }}</span>)</span></span></a>
        </div>
        {{--cart--}}
            <div class="header-cart-content">
            <div class="cart-header">
                <div class="float-left pl-2">Số sản phẩm: <span class="qty" id="qty">{{ \Cart::content() ? \Cart::content()->count() : 0 }}</span></div>
{{--                <div class="float-right pr-2">Tổng số lượng: 100</div>--}}
                <div class="clearfix"></div>
            </div>
                <div id="shopping-cart-list"></div>
            <?php $carts = \Cart::content() ?? null ?>
                @if ($carts != null)
                    @foreach($carts as $cart)
                    <div class="cart-content mt-3" id="cart-{{ $cart->rowId }}">
                        <div class="cart-product-image float-left col-md-3">
                            <img src="{{ $cart->options ? $cart->options->image_url : '' }}" width="100%">
                        </div>
                        <div class="float-left col-md-9 mb-3">
                            <div class="float-left">
                                <a href="#"><a href="#">{{ $cart->name }}</a></h2> (<span class="qty"><span id="item-{{ $cart->rowId }}-qty">{{ $cart->qty }}</span></span>)</a>
                                <div> x <span id="item-{{ $cart->rowId }}-price">{{ number_format($cart->price) }}</span> đ</div>
                            </div>
                            <div class="float-right"><i class="fa fa-trash remove-item-cart" aria-hidden="true" onclick="deleteCart({{ $cart->id }}, '{{ $cart->rowId }}', '{{ __('app.confirm') }}', '{{ __('cart.confirm') }}')"></i></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @endforeach
                @endif
            <div class="cart-footer">
                <div class="float-left"><a href="{{ route('carts.checkout') }}" class="btn btn-success text-light">Thanh toán</a></div>
                <div class="float-right amount">Số tiền: <span id="subtotal">{{ \Cart::subtotal() ? number_format(\Cart::subtotal(0,'.','')) : 0 }}</span> đ</div>
                <div class="clearfix"></div>
            </div>
        </div>
        {{--end cart--}}
    </div>
    <div class="clearfix"></div>
</div>

<script>
    function deleteCart(product_id, rowId, confirm, title) {
        alertify.confirm(confirm, title,
            function(){
                $.ajax({
                    url: window.location.origin + '/carts/' + rowId + '/destroy',
                    method: 'DELETE',
                    success: function(data) {
                        $('#subtotal').text(data.subtotal)
                        $('#cart-' + rowId).hide();
                        if (parseInt($('#qty').text()) > 0) {
                            var q = parseInt($('#qty').text()) - 1;
                            $('.qty').text(q)
                        }
                        alertify.success(data.status);
                    },
                    error: function(error) {
                        console.log(error)
                    }
                })
            },
            function(){

            }
        )
    }
</script>
