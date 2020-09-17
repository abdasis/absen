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
            <li class="breadcrumb-item active">Tambah Sift</li>
        </ol>
    </div>
    <!-- /.col -->
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card card-outline card-primary">
            <div class="card-header">
                Tambah Data Sift Karyawan
            </div>
            <div class="card-body">
                <form action="{{ route('karyawan.sift-store', ['sift_id' => $sift_id]) }}" method="post">
                    @csrf
                    <input type="hidden">
                    <div class="form-group">
                        <label for="karyawan">Karyawan</label>
                        <select class="custom-select" name="karyawan" id="karyawan">
                            <option selected>Pilih Karyawan</option>
                            @foreach ($karyawans as $karyawan)
                            <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary"><i class="fa fa-save mr-1"></i>Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
