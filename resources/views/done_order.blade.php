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
      @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      <a href="{{ route('home') }}" class="btn btn-success">{{ __('app.home') }}</a>
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
