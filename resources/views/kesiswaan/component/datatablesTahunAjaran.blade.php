<a href="{{ route('get.tahunAjaranKesiswaanDetail', \Illuminate\Support\Facades\Crypt::encrypt($tahun_ajaran)) }}" class="btn btn-primary">Detail</a>
<button onclick="funHapus('{{$id_tahun_ajaran}}', '{{ $tahun_ajaran }}')" class="btn btn-danger">Hapus</button>
