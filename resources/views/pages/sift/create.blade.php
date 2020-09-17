@extends('layouts.app')
@section('page-title')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Sift</h1>
    </div>
    <!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Sift</a></li>
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
                Tambah Data Sift
            </div>
            <div class="card-body">
                <form action="{{ route('sift.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Sift</label>
                        <input type="text" name="nama" id="nama" placeholder="Malam" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="masuk">Masuk</label>
                        <input class="form-control" placeholder="07:00" type="text" name="masuk" id="masuk" class="form-group">
                        <small>Ex: 07:00</small>
                    </div>

                    <div class="form-group">
                        <label for="keluar">Keluar</label>
                        <input type="text" class="form-control" placeholder="17:00" name="keluar" id="keluar" class="form-group">
                        <small>Ex: 17:00</small>
                    </div>

                    <button class="btn btn-primary"><i class="fa fa-save mr-1"></i>Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
