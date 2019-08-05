@extends('admin.layouts.master')

@section('title', 'Tin tức')
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
                        <li class="breadcrumb-item active">Tin tức</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="row col-md-12">
        <div class="col-12">
            <a class="btn btn-success mb-3" id="new-record" href="{{ route('news.create') }}">{{ __('app.new') }}</a>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tin tức</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tiêu đề</th>
                            <th>Hình ảnh</th>
                            <th>Tạo lúc</th>
                            <th>Miêu tả</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$listNews)
                            <tr>
                                <td colspan="6"><div class="alert alert-danger">Không có bản ghi nào</div></td>
                            </tr>
                        @else
                        @foreach($listNews as $news)
                        <tr>
                            <td>1</td>
                            <td>{{ $news->title }}</td>
                            <td style="width: 50px;"><img src="{{ asset('images/news/' . $news->image) }}" width="100%"></td>
                            <td>{{ $news->created_at }}</td>
                            <td>{{ $news->description }}</td>
                            <td>
                                <div class="form-group">
                                    <div class="row">
                                        <a class="text-primary fa fa-edit ml-2" id="edit-icon" href="{{ route('news.edit', ['id' => $news->id]) }}"></a>
                                        {{ Form::open(['route' => ['news.destroy', 'id' => $news->id], 'method' => 'DELETE']) }}
                                        <button type="submit" class="fa fa-trash ml-2" id="btn-delete" onclick="return confirm('Bạn thật sự muốn xóa chứ?')"></button>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        @endif
                    </table>
                    <div class="mt-4">
                        {{ $listNews->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <!-- Button trigger modal -->
        <!-- Modal -->
        <style type="text/css">
            #edit-icon:hover{
                cursor: pointer;
            }
            #btn-delete:hover {
                cursor: pointer;
            }
        </style>
@endsection
