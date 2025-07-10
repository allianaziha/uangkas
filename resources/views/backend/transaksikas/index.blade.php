@extends('layouts.backend')
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary text-white mb-4">
                    Data Transaksi Kas
                    <a href="{{ route('backend.transaksikas.create') }}" class="btn btn-info btn-sm" style="color:white; float: right;">
                        Tambah
                    </a>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table" id="dataTransaksiKas">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksikas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($data->jenis) }}</td>
                                    <td>{{ $data->jumlah }}</td>
                                    <td>{{ $data->keterangan }}</td>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>
                                        <a href="{{ route('backend.transaksikas.edit', $data->id) }}" class="btn btn-warning btn-sm">Ubah</a> |
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
