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
                        <li class="breadcrumb-item active">Sửa công ty</li>
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

    {!! Form::open(['method' => 'PUT', 'route' => ['companies.update', 'id' => $company->id]]) !!}
    <div class="row col-md-12 ml-3">
        <div class="col-md-8" style="border-bottom: 1px solid #9999">
            <h1>Về công ty</h1>
        </div>
        {{-- <form> --}}
        <div class="col-md-6 mt-3 mb-5">
            <div class="form-group">
                <label for="name">Tên</label>
                <input type="text" name="name" class="form-control" value="{{ $company->name }}">
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ</label>
                <input type="address" name="address" class="form-control" value="{{ $company->address }}">
            </div>

            <div class="form-group ">
                <label for="phone">Điện thoại</label>
                <input type="number" class="form-control" name="phone" value="{{ $company->phone }}">
            </div>

            <div class="form-group ">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $company->email }}">
            </div>

            <div class="form-group">
                <label for="about">Giới thiệu</label>
                <textarea name="about" class="form-control">{{ $company->about }}</textarea>
            </div>
            <div class="form-group">
                <label for="contact">Liên hệ</label>
                <textarea name="contact" class="form-control">{{ $company->contact }}</textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="{{ __('app.new') }}" class="btn btn-info">
            </div>
        </div>
        {{-- </form> --}}
    </div>
    {{ Form::close() }}
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace('about');
        CKEDITOR.replace('contact');
    </script>
@endsection
