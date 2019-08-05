@extends('admin.layouts.master')

@section('title','Công ty')
@section('content')
    <section class="content-header ml-2">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{ __('app.home') }}</a></li>
                        <li class="breadcrumb-item active">Tạo công ty</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @if(count($errors->all()) > 0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    {!! Form::open(['method' => 'PUT', 'route' => ['news.update', 'id' => $news->id], 'files' => 'true']) !!}
    <div class="row col-md-12 ml-3">
        <div class="col-md-8" style="border-bottom: 1px solid #9999">
            <h1>Tin tức</h1>
        </div>
        {{-- <form> --}}
        <div class="col-md-6 mt-3 mb-5">
            <div class="form-group">
                <label for="name">Tiêu đề</label>
                <input type="text" name="title" class="form-control" value="{{ $news->title }}">
            </div>
            <div class="form-group">
                <label for="address">Miêu tả</label>
                <input type="description" name="description" class="form-control" value="{{ $news->description }}">
            </div>

            <div class="form-group">
                <label for="content">Ảnh</label>
                <input type="file" class="form-control image" name="image">
                <div class="img-preview"><img src="{{ asset('images/news/'. $news->image) }}" width="50%"></div>
            </div>

            <div class="form-group">
                <label for="content">Nội dung</label>
                <textarea name="content" class="form-control">{{ $news->content }}</textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Sửa" class="btn btn-info">
            </div>
        </div>
        {{-- </form> --}}
    </div>
    {{ Form::close() }}
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace('content');


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.img-preview img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('.image').change(function () {
            readURL(this);
        });
    </script>
@endsection
