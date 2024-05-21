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
                            <a class="btn btn-primary btn-sm btn-rounded" href="{{ route('siswa.create') }}"><i
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
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Saldo</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_siswa }}</td>
                                        <td>
                                            Rp.{{ number_format($data->saldo, 0, ',', '.') }}</td>
                                        <td>
                                            <form action="{{ route('siswa.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                {{-- <a href="{{route('siswa.show',$data->id)}}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a> --}}
                                                <a class="btn btn-warning btn-sm btn-rounded "
                                                    href="{{ route('siswa.edit', $data->id) }}"> <i
                                                        class="fa fa-edit"></i></a>
                                                <button type="submit" class="btn btn-danger btn-sm btn-rounded"
                                                    onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini?')"><i
                                                        class="fa fa-trash"></i></button>
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
