@extends('admin.layouts.master')

@section('title', 'Về công ty')
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
                        <li class="breadcrumb-item active">Về công ty</li>
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
            <a class="btn btn-success mb-3" id="new-record" href="{{ route('companies.create') }}">{{ __('app.new') }}</a>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Công ty</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Địa chỉ</th>
                            <th>Điện thoại</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if(!$company)
                                    <td class="alert alert-danger" colspan="5">Chưa có bản ghi nào</td>
                                @else
                                <td>1</td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->address }}</td>
                                <td>{{ $company->phone }}</td>
                                <td>{{ $company->email }}</td>
                                <td>
                                    <div class="form-group">
                                        <div class="row">
                                            <a class="text-primary fa fa-edit ml-2" id="edit-icon" href="{{ route('companies.edit', ['id' => $company->id]) }}"></a>
                                            {{ Form::open(['route' => ['companies.destroy', 'id' => $company->id], 'method' => 'DELETE']) }}
                                                <button type="submit" class="fa fa-trash ml-2" id="btn-delete" onclick="return confirm('Bạn thật sự muốn xóa chứ?')"></button>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </td>
                                    @endif
                            </tr>
                        </tbody>
                    </table>
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
