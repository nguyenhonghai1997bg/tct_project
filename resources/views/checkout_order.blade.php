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
      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      @if(count($errors->all()))
        @foreach($errors->all() as $error)
          <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
      @endif
      @if(session('warning'))
          <div class="alert alert-warning">{{ session('warning') }}</div>
      @endif
    <div class="col-md-9 col-sm-12 col-xs-12 float-left">
      <!-- row -->
      <div class="row">
          {{ Form::open(['route' => 'orders.store', 'id' => 'checkout-form', 'class' => 'clearfix']) }}
          <div class="col-md-6 float-left" style="border-right: 1px solid #666666;">
            <div class="billing-details">
            @if(!Auth::check())
              <a href="{{ route('login') }}" class="btn btn-info">{{ __('app.login') }}</a></p>
            @endif
              <div class="section-title">
                <h3 class="title">{{ __('carts.billing') }}</h3>
              </div>
              <div class="form-group">
              </div>
              <div class="form-group">
                <input class="form-control" type="text" name="name" placeholder="{{ __('users.name') }}" value="{{ Auth::user() ? Auth::user()->name : '' }}" class="form-control">
              </div>
              <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="{{ __('users.email') }}" value="{{ Auth::user() ? Auth::user()->email : '' }}">
              </div>
              <div class="form-group">
                <input class="form-control" type="text" name="address" id="address-order" placeholder="{{ __('users.address') }}" value="{{ Auth::user() ? Auth::user()->address : '' }}">
                <div class="text-danger" id="err-address"></div>
                {{-- <input type="hidden" id="ship" value="-1" name="ship"> --}}
              </div>
              <div class="form-group">
                <input class="form-control" type="number" name="phone" placeholder="{{ __('users.phone') }}" value="{{ Auth::user() ? Auth::user()->phone ?? '' : '' }}">
              </div>
            </div>
          </div>

          <div class="col-md-6 float-left">
            <div class="payments-methods">
              <div class="section-title">
                <h4 class="title">{{ __('app.paymethods') }}</h4>
              </div>
              <div class="col-md-12">
              <select name="paymethod_id" class="form-control" id="paymethod_id" style="margin-bottom: 30px;">
                @foreach(\App\Paymethod::all(['id', 'name']) as $paymethod)
                  <option value="{{ $paymethod->id }}">{{ $paymethod->name }}</option>
                @endforeach
              </select>
              </div>
              <div style="display:none;" id="bank_code">
                <div>
                  <label>Chọn ngân hàng</label>
                    <select name="bankcode" id="bankcode" class="form-control">
                        <option value>Không chọn </option>            
                        <option value="VNPAYQR">VNPAYQR</option>
                        <option value="VNBANK">LOCAL BANK</option>
                        <option value="IB">INTERNET BANKING</option>
                        <option value="ATM">ATM CARD</option>
                        <option value="INTCARD">INTERNATIONAL CARD</option>
                        <option value="VISA">VISA</option>
                        <option value="MASTERCARD"> MASTERCARD</option>
                        <option value="JCB">JCB</option>
                        <option value="UPI">UPI</option>
                        <option value="VIB">VIB</option>
                        <option value="VIETCAPITALBANK">VIETCAPITALBANK</option>
                        <option value="SCB">Ngan hang SCB</option>
                        <option value="NCB">Ngan hang NCB</option>
                        <option value="SACOMBANK">Ngan hang SacomBank  </option>
                        <option value="EXIMBANK">Ngan hang EximBank </option>
                        <option value="MSBANK">Ngan hang MSBANK </option>
                        <option value="NAMABANK">Ngan hang NamABank </option>
                        <option value="VNMART"> Vi dien tu VnMart</option>
                        <option value="VIETINBANK">Ngan hang Vietinbank  </option>
                        <option value="VIETCOMBANK">Ngan hang VCB </option>
                        <option value="HDBANK">Ngan hang HDBank</option>
                        <option value="DONGABANK">Ngan hang Dong A</option>
                        <option value="TPBANK">Ngân hàng TPBank </option>
                        <option value="OJB">Ngân hàng OceanBank</option>
                        <option value="BIDV">Ngân hàng BIDV </option>
                        <option value="TECHCOMBANK">Ngân hàng Techcombank </option>
                        <option value="VPBANK">Ngan hang VPBank </option>
                        <option value="AGRIBANK">Ngan hang Agribank </option>
                        <option value="MBBANK">Ngan hang MBBank </option>
                        <option value="ACB">Ngan hang ACB </option>
                        <option value="OCB">Ngan hang OCB </option>
                        <option value="IVB">Ngan hang IVB </option>
                        <option value="SHB">Ngan hang SHB </option>
                      </select>
                </div>
              </div>

              {{-- @foreach(\App\Paymethod::all(['id', 'name']) as $paymethod)
              <div class="input-checkbox">
                {!! Form::radio('paymethod_id', $paymethod->id, false, ['id' => 'payments' . $paymethod->id]) !!}
                <label for="payments{{ $paymethod->id }}" >{{ $paymethod->name }}</label>
              </div>
              @endforeach --}}
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-12 mt-4">
            <div class="order-summary clearfix">
              <div class="section-title">
                <h3 class="title">{{ __('carts.orderDetail') }}</h3>
              </div>
              <table class="shopping-cart-table table table-bordered">
                <thead>
                  <tr>
                    <th>{{ __('carts.product') }}</th>
                    <th></th>
                    <th class="text-center">{{ __('carts.price') }}</th>
                    <th class="text-center">{{ __('carts.quantity') }}</th>
                    <th class="text-center">{{ __('carts.total') }}</th>
                    <th class="text-right"></th>
                  </tr>
                </thead>
                <tbody>
                  @if(\Cart::content())
                    @foreach(\Cart::content() as $cart)
                    <tr id="row-{{ $cart->rowId }}" style="line-height: 20px;">
                      <td style="width: 10%;">
                        <img src="{{ $cart->options->image_url }}" alt="" width="100%">
                      </td>
                      <td class="details">
                        <a href="{{ route('frontend.products.show', ['id' => $cart->id, 'slug' => \Str::slug($cart->name, '-')]) }}">{{ $cart->name }}</a>
                      </td>
                      <td class="price text-center"><strong>{{ number_format($cart->price) }} VND</strong></td>
                      <td class="qty text-center">
                        <input class="form-control" type="number" value="{{ $cart->qty }}" id="qty-{{ $cart->rowId }}" onchange="updateCart('{{ $cart->rowId }}')">
                      </td>
                      <td class="total text-center"><strong class="primary-color" id="price-row-{{ $cart->rowId }}">{{ number_format($cart->price * $cart->qty) }}</strong></td>
                      <td class="text-right">
                        <a href="#" class="main-btn icon-btn" onclick="deleteCart({{ $cart->id }}, '{{ $cart->rowId }}', '{{ __('app.confirm') }}', '{{ __('carts.confirm') }}')"><i class="fa fa-close"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  @endif
                </tbody>
                <tfoot>
                  <tr>
                    <th class="empty" colspan="3"></th>
                    <th>{{ __('carts.subTotal') }}</th>
                    <th colspan="2" class="total" id="total">{{ number_format(\Cart::subtotal(0,'.','')) }} + <span id="money-ship">0</span> ({{ __('orders.ship') }} <span id="km"> </span>)</th>
                  </tr>
                </tfoot>
              </table>
              <div class="pull-right">
                <button class="btn btn-success">{{ __('orders.order') }}</button>
              </div>
            </div>

          </div>
        {{ Form::close() }}
    </div>
  </div>
    <!-- /row -->
  <div class="col-md-3 col-sm-12 col-xs-12 float-right">
      @include('customer/nav-right')
    </div>
    <div class="clearfix"></div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('custom/checkout.js') }}"></script>
@endsection
