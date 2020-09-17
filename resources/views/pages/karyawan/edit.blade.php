@extends('layouts.app')

@section('page-title')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Karyawan</h1>
    </div>
    <!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Karyawan</a></li>
            <li class="breadcrumb-item active">Tambah Data</li>
        </ol>
    </div>
    <!-- /.col -->
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Tambah Karyawan
            </div>

            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <form action="{{ route('karyawan.update', $karyawan->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nik">Kode Karyawan</label>
                                <input type="text" class="form-control" value="{{ $karyawan->kode }}" name="kode" placeholder="123456789">
                            </div>

                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" name="nik" value="{{ $karyawan->nik }}" placeholder="123456789">
                            </div>

                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Abd. Asis" value="{{ $karyawan->nama }}">
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="5" placeholder="Rongdurin, Tanah Merah">{{ $karyawan->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save mr-1"></i>Update</button>
                                <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-undo-alt mr-1"></i>Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
