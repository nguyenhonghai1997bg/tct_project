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
            <h1>{{ $news->title }}</h1>
            <h5 class="mt-3">Tạo lúc: {{ $news->created_at }}</h5>
            <div class="mt-4">{!! $news->content !!}</div>

            <a href="{{ route('users.news_index') }}" class="btn btn-info mt-5">Back</a>
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
