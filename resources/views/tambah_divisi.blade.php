@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
@endpush
@section('contents')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid" id="main-content">
                <!-- Content will be dynamically loaded here -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Tambah Jabatan
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <form action="{{ url('storedivisi') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama">Nama Jabatan</label>
                                        <input type="text" class="form-control" name="nama" required>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#tabledivisi', {
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "ordering": true,
            "ajax": {
                "url": "{{ url('get_datatables_divisi') }}",
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
