@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
@endpush
@section('contents')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid" id="main-content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Edit Pegawai
                                </h3>
                            </div>
                            <form action="{{ url('update') }}" method="post">
                                @csrf
                                <input type="text" name="id_pegawai" value="{!! \App\Helpers\EncryptionHelper::encrypt_str($pegawai->id) !!}" hidden>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" name="nama"
                                            value="{{ $pegawai->nama }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jk">Jenis Kelamin</label>
                                        <select class="form-control" name="jk" required>
                                            <option value="laki-laki"{{ $pegawai->jk == 'Laki-laki' ? ' selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="perempuan"{{ $pegawai->jk == 'Perempuan' ? ' selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="divisi">Divisi</label>
                                        <select class="form-control" name="divisi" required>
                                            @foreach ($divisi as $d)
                                                <option
                                                    value="{{ $d->id }}"{{ $d->nama == $d->nama ? 'selected' : '' }}>
                                                    {{ $d->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
