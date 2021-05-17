@extends('kesiswaan.shared.layout')

@section('title', 'Tahun Ajaran '.$tahun_ajaran)

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tahun Ajaran {{ $tahun_ajaran }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('get.dashboardKesiswaan') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Tahun Ajaran</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <button id="btnTambah" class="btn btn-primary">Tambah</button>
                    <button id="btnImport" class="btn btn-success" data-toggle="modal" data-target="#modalImport">Import</button>
                </div>
            </div>
            @if($errors->any())
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="alert alert-danger mt-3 mr-2 ml-2">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Siswa Tahun Ajaran {{ $tahun_ajaran }}</h3>
                            </div>
                            <div class="card-body">
                                <table id="tabel-siswa" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th># No</th>
                                            <th>Nama Siswa</th>
                                            <th>Tingkat</th>
                                            <th>Kelas</th>
                                            <th>NIS</th>
                                            <th>NISN</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('post.tahunAjaranKesiswaanImport') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Import Excel</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="file" name="file_excel" accept=".xls,.xlsx"/>
                            <input type="hidden" name="tahun_ajaran" value="{{ $tahun_ajaran }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        let url = "{{ route('post.tahunAjaranKesiswaanDetail') }}";
        let tahunAjaran = "{{ $tahun_ajaran }}";
        let _token = $('meta[name="csrf-token"]').attr('content');
        let tabel = $('#tabel-siswa').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                type: "POST",
                url: url,
                data: {
                    _token: _token,
                    _tahun_ajaran: tahunAjaran
                }
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_ROwIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    data: 'nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'tingkat',
                    name: 'tingkat'
                },
                {
                    data: 'kelas',
                    name: 'kelas'
                },
                {
                    data: 'NIS',
                    name: 'NIS'
                },
                {
                    data: 'NISN',
                    name: 'NISN'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                }
            ],
            order: [[0, 'asc']],
        });
    </script>
@endpush
