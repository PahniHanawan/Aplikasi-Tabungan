@extends('layouts.master')
@section('breadcrumbs')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">List Siswa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}
                            <a class="btn btn-primary btn-sm btn-rounded" href="{{ route('users.create') }}"><i
                                    class="fa-solid fa-plus"></i></a>
                        </h4>
                        </h4>

                        @if (Session::has('sukses'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                                {{ Session::get('sukses') }}
                            </div>
                        @endif

                        @if (Session::has('gagal'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
                                {{ Session::get('gagal') }}
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-blue">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach ($user as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>
                                            @if ($data->role === 'Admin')
                                                <button class="btn  btn-sm btn-info">{{ $data->role }}</button>
                                            @else
                                                <button class="btn btn-sm btn-success">{{ $data->role }}</button>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('users.destroy', $data->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                @if ($data->role == 'user')
                                                    <a
                                                        href="{{ route('users.edit', $data->id) }}"class="btn btn-success">Edit</a>
                                                @else
                                                @endif
                                                {{-- <a href="{{ route('users.show', $data->id) }}"class="btn btn-warning"><i class="fas fa-eye"></i></a> --}}
                                                @if ($data->role == 'Admin')
                                                @else
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('apakah anda yakin ?')"><i
                                                            class="fa fa-trash"></i></button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
