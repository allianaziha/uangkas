@extends('layouts.backend')
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-dark">
                    DATA TRANSAKSI KAS
                    <a href="{{ route('backend.transaksikas.create') }}" class="btn btn-primary btn-sm" style="color:white; float: right;">
                        Tambah
                    </a>
                </div>
                <div class="card-body">
                        <table class="table" id="dataTransaksiKas">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th class="text-white">#</th>
                                    <th class="text-white">Jenis</th>
                                    <th class="text-white">Jumlah</th>
                                    <th class="text-white">Keterangan</th>
                                    <th class="text-white">Tanggal</th>
                                    <th class="text-white">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksikas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($data->jenis == 'pengeluaran')
                                            <span class="badge bg-danger">pengeluaran</span>
                                        @else
                                            <span class="badge bg-success text-dark">pemasukan</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data->jenis == 'pengeluaran')
                                            <span >- {{ number_format($data->jumlah, 0, ',', '.') }}</span>
                                        @else
                                            <span >+ {{ number_format($data->jumlah, 0, ',', '.') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $data->keterangan }}</td>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>
                                        <a href="{{ route('backend.transaksikas.edit', $data->id) }}" class="btn btn-warning btn-sm">Ubah</a> 
                                            <form action="{{ route('backend.transaksikas.destroy', $data->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="bi bi-trash">Hapus</i>
                                                </button>
                                            </form>
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
    new DataTable('#dataTransaksiKas');
</script>
@endpush
