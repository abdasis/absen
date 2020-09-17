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

                            <div class="form-group">
                                <label for="user_id">User ID</label>
                                <input type="text" class="form-control" name="user_id" placeholder="User Id">
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="custom-select" name="role" id="role">
                                    <option selected>Pilih Role</option>
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" name="nik" placeholder="123456789">
                            </div>

                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Abd. Asis">
                            </div>

                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" class="form-control" name="telepon" placeholder="Telepon">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="email">
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="5" placeholder="Rongdurin, Tanah Merah"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" name="password" placeholder="password">
                                <small class="text-muted">Maksimal 8 Digit angka</small>
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
