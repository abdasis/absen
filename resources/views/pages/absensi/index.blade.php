@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('page-title')

<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Karyawan</h1>
    </div>
    <!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Karyawan</a></li>
            <li class="breadcrumb-item active">Data Absensi</li>
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
            <a href="{{ route('absensi.index', ['ip' => "192.168.1.11"]) }}">
                <button class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i>Sync Data</button>
            </a>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data Karyawan
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-borderless table-hover table-sm">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Jam</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($buffers as $key => $buffer)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $buffer->tanggal_absen }}</td>
                                <td>{{ $buffer->nama }}</td>
                                <td>{{ $buffer->alamat }}</td>
                                <td>
                                    @if (strtotime(Str::substr($buffer->tanggal_absen, 11, 5)) < strtotime($buffer->masuk))
                                        <div class="badge badge-success">Tepat Waktu</div>
                                    @else
                                        <div class="badge badge-warning">Telat</div>
                                    @endif
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
