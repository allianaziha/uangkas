@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header text-dark">
                    DATA PEMBAYARAN
                    <a href="{{ route('backend.pembayaran.create') }}" class="btn btn-primary btn-sm float-end text-white">
                        Tambah
                    </a>
                </div>
                <div class="card-body">
                        <table class="table" id="dataPembayaran">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Siswa</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pembayarans as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name ?? '-' }}</td>
                                    <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('backend.pembayaran.edit', $item->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                        <form action="{{ route('backend.pembayaran.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus</button>
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
    new DataTable('#dataPembayaran');
</script>
@endpush
