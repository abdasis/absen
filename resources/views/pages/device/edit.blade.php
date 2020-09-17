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
                        <form action="{{ route('karyawan.store') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="uid">IP Address</label>
                                <input type="text" class="form-control" name="ip" value="{{ $device->ip }}" placeholder="192.168.1.1">
                            </div>

                            <div class="form-group">
                                <label for="user_id">Port</label>
                                <input type="text" class="form-control" name="port" value="{{ $device->port }}" placeholder="80">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save mr-1"></i>Simpan</button>
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
