@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-dark ">
                    DATA SISWA
                    <a href="{{ route('backend.siswa.create') }}" class="btn btn-primary btn-sm" style="color:white; float: right;">
                        Tambah
                    </a>
                </div>
                <div class="card-body">
                        <table class="table" id="dataSiswa">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th class="text-white">#</th>
                                    <th class="text-white">Nama</th>
                                    <th class="text-white">Jabatan</th>
                                    <th class="text-white">Email</th>
                                    <th class="text-white">Status Bayar</th>
                                    <th class="text-white">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($users as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->name }}</td>
                                    @if ($data->isAdmin == 1)
                                        <td>Bendahara</td>
                                    @else
                                        <td>Siswa</td>
                                    @endif
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->status_semester ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('backend.siswa.edit', $data->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                        @if($data->isAdmin != 1)
                                        <form action="{{ route('backend.siswa.destroy', $data->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
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
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
<script>
    new DataTable('#dataSiswa');
</script>
@endpush
