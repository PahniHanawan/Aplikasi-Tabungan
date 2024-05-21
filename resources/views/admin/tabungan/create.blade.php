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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">List Tabungan</li>
                        <li class="breadcrumb-item active">Create tabungan</li>
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
                        <form action="{{ route('tabungan.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Nama Siswa</label>
                                <select name="siswa_id" class="form-control">
                                    @foreach ($siswa as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_siswa }}</option>
                                    @endforeach
                                </select>
                                <label>Pemasukan</label>
                                <input type="number" name="pemasukan" class="form-control" placeholder="Pemasukan Siswa"
                                    required>
                                <label>Pengeluaran</label>
                                <input type="number" name="pengeluaran" class="form-control"
                                    placeholder="Pengeluaran Siswa" required>
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" placeholder="Masukkan Tanggal"
                                    required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('tabungan.index') }}" class="btn btn-warning btn-block">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
