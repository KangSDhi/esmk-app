@extends('kesiswaan.shared.layout')

@section('title', $title)

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tahun Ajaran</h1>
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
                    <button id="btnTambah" class="btn btn-primary mt-1">Tambah</button>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Tahun Ajaran</h3>
                            </div>
                            <div class="card-body">
                                <table id="tabel-tahun-ajaran" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th># No</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Update</th>
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

        <div id="mymodal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Tambah Tahun Ajaran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="tagForm" id="tag-form" action="#" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <label for="tagTahun">Tahun Ajaran</label>
                            <input id="tagTahun" class="form-control" type="text" maxlength="9"/>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <input id="tag-form-submit" type="submit" class="btn btn-primary" value="Tambah">
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
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script>
        let url = "{{ route('post.tahunAjaranKesiswaan') }}";
        let _token = $('meta[name="csrf-token"]').attr('content');
        let tabel = $('#tabel-tahun-ajaran').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                type: "POST",
                url: url,
                data: {
                    _token: _token
                }
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    data: 'tahun_ajaran',
                    name: 'tahun_ajaran'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    className: 'text-center'
                }
            ],
            order: [[0, 'asc']],
        });

        $("#btnTambah").click(function(e){
           e.preventDefault();
           $('#mymodal').modal();
        });

        $(function (){
           $('#tag-form-submit').on('click', function(e){
              e.preventDefault();
              $.ajax({
                  type: "POST",
                  url: "{{ route('post.tahunAjaranKesiswaanStore') }}",
                  data: {
                      _token: _token,
                      tahun_ajaran: $('#tagTahun').val()
                  },
                  success: function(res){
                      if (res.status === 200){
                          Swal.fire({
                              icon: "success",
                              title: "Ok"
                          });
                          tabel.ajax.reload();
                          $('#mymodal').modal('hide');
                      }
                  },
                  error: function(){

                  }
              })
           });
        });

        function funHapus(id, tahun_ajaran){
            Swal.fire({
                icon: "warning",
                title: "Hapus Tahun Ajaran "+tahun_ajaran,
                text: "Anda Yakin Menghapus Tahun Ajaran Beserta Data Siswa?",
                showCancelButton: true,
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed){
                    $.ajax({
                        type: "POST",
                        url: "{{ route('post.tahunAjaranKesiswaanDestroy') }}",
                        data: {
                            _token: _token,
                            tahun_ajaran: tahun_ajaran,
                            id_tahun_ajaran: id
                        },
                        success: function (res){
                            if (res.status === 200){
                                Swal.fire('Dihapus', '', 'success');
                                tabel.ajax.reload();
                            }
                        },
                        error: function(){

                        }
                    })
                }else if(result.dismiss === Swal.DismissReason.cancel){
                    Swal.fire('Batal', '', 'error')
                }
            })
        }
    </script>
@endpush
