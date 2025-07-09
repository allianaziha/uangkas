@extends('layouts.backend')
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-secondary">
                    Data Kas Mingguan
                    <a href="{{ route('backend.kas_mingguan.create') }}" class="btn btn-info btn-sm" style="color:white; float: right;">
                        Tambah
                    </a>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table" id="dataKasMingguan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Minggu Ke</th>
                                    <th>Bulan</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kas_mingguan as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>{{ $data->minggu_ke }}</td>
                                    <td>{{ $data->bulan }}</td>
                                    <td>{{ $data->jumlah }}</td>
                                    <td>{{ $data->tanggal_bayar }}</td>
                                    <td>
                                        <a href="{{ route('backend.kas_mingguan.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a> |
                                        <a href="{{ route('backend.kas_mingguan.destroy', $data->id) }}" class="btn btn-danger btn-sm" data-confirm-delete="true">Delete</a>
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
    new DataTable('#dataKasMingguan');
</script>
@endpush
