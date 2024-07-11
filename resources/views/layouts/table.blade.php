@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
@endpush
@section('contents')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Data Tables
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Data Pegawai
                                </h3>
                                {{-- --------------------Tambah Pegawai-------------------- --}}
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-4">
                                        <li class="nav-item">
                                            <a class="btn btn-primary" href="{{ url('tambahpegawai') }}">
                                                <i class="fa fa-plus"></i> Tambah</a>
                                        </li>
                                    </ul>
                                </div>
                                {{-- --------------------Export to Excel-------------------- --}}
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-4">
                                        <li class="nav-item">
                                            <a href="{{ url('export') }}" class="btn btn-success">
                                                <i class="fa fa-upload"></i> Export to Excel</a>
                                        </li>
                                    </ul>
                                </div>
                                {{-- --------------------Import from Excel-------------------- --}}
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-4">
                                        <li class="nav-item">
                                            <a href="{{ url('importpegawai') }}" class="btn btn-primary">
                                                <i class="fa fa-download"></i> Import from Excel</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="tablepegawai" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Divisi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('scripts')
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#tablepegawai', {
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "ordering": true,
            "ajax": {
                "url": "{{ url('get_datatables') }}",
                "type": 'GET',
                "data": {},
                "dataSrc": function(json) {
                    return json.data;
                }
            },
            "columnDefs": [{
                    targets: [1],
                    orderable: true,
                    className: "vmiddle"
                },
                {
                    targets: [2],
                    className: "vmiddle"
                },
            ]
        });
    </script>
@endpush
