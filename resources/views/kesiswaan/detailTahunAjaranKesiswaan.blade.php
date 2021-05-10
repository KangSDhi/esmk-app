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
    </div>
@endsection

@push('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
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
