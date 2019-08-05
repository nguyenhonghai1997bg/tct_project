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
            @foreach($listNews as $news)
           <div style="border: 1px solid #e8e8e8;" class="mb-4">
               <div class="col-md-3 float-left p-2">
                    <img src="{{ asset('images/news/' . $news->image) }}" width="100%">
               </div>
               <div class="col-md-9 float-left p-2">
                   <h1><a href="{{ route('users.news_detail', ['id' => $news->id, 'slug' => $news->slug]) }}" style="color: green;">{{ $news->title }}</a></h1>
                    <h5 class="mt-3">Tạo lúc: {{ $news->created_at }}</h5>
                   <div class="mt-4">{{ $news->description }}</div>
               </div>
               <div class="clearfix"></div>
           </div>
            @endforeach

            <div class="mt-3">
                {{ $listNews->links() }}
            </div>
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
