@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('page-title')

<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Sift</h1>
    </div>
    <!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Sift</a></li>
            <li class="breadcrumb-item active">Data Sift</li>
        </ol>
    </div>
    <!-- /.col -->
</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 mb-2">
            @if(Session::has('status'))
                <div class="alert alert-success mb-2">
                    {{ Session::get('status') }}
                </div>
            @endif
            <a href="{{ route('sift.create') }}">
                <button class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i>Tambah Sift</button>
            </a>

        </div>
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    Data sift
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover table-sm">
                        <thead>
                          <tr>
                            <th scope="row">#</th>
                            <th>Sift</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Option</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($sifts as $key => $sift)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $sift->name }}</td>
                                <td>{{ $sift->masuk }}</td>
                                <td>{{ $sift->keluar }}</td>
                                <td>
                                    <div class="row justify-content-center">
                                        <form action="{{ route('sift.destroy', $sift->id) }}" method="post" onsubmit="return confirm('Yakin untuk hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger mr-1"><i class="fa fa-trash-alt"></i></button>
                                        </form>
                                        <a href="{{ route('karyawan.sift', ['sift_id' => $sift->id ]) }}">
                                            <button class="btn btn-success btn-sm mr-1"><i class="fa fa-user-plus mr-1"></i></button>
                                        </a>
                                        <a href="{{ route('karyawan.sift', ['sift_id' => $sift->id ]) }}">
                                            <button class="btn btn-warning btn-sm"><i class="fa fa-list-ol mr-1"></i></button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

  </script>
@endsection
