@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-dark d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">DATA KAS MINGGUAN</h5>
                    <div class="d-flex gap-2">
                    </div>
                </div>
                <div class="card-body">

                    {{-- Filter --}}
                    <form method="GET" id="filterForm" class="row g-2 mb-3">
                        <div class="col-md-3">
                            <select name="bulan" class="form-select" onchange="document.getElementById('filterForm').submit();">
                                <option value="">-- Filter Bulan --</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="minggu_ke" class="form-select" onchange="document.getElementById('filterForm').submit();">
                                <option value="">-- Filter Minggu Ke --</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ request('minggu_ke') == $i ? 'selected' : '' }}>
                                        Minggu ke-{{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </form>

                    {{-- Tabel --}}
                    <div class="table-responsive border rounded-4">
                        <table class="table" id="dataKasMingguan">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th class="text-white">#</th>
                                    <th class="text-white">Nama</th>
                                    <th class="text-white">Status</th>
                                    <th class="text-white">Minggu Ke</th>
                                    <th class="text-white">Bulan</th>
                                    <th class="text-white">Jumlah</th>
                                    <th class="text-white">Tanggal Bayar</th>
                                    <th class="text-white">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kas_mingguan as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>
                                        @if ($data->status == 'lunas')
                                            <span class="badge bg-success">Lunas</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Belum</span>
                                        @endif
                                    </td>
                                    <td>{{ $data->minggu_ke }}</td>
                                    <td>{{ \Carbon\Carbon::create()->month($data->bulan)->translatedFormat('F') }}</td>
                                    <td>{{ number_format($data->jumlah) }}</td>
                                    <td>{{ $data->tanggal_bayar }}</td>
                                    <td>
                                        <a href="{{ route('backend.kas_mingguan.show', $data->id) }}" class="btn btn-success btn-sm">Detail</a>
                                        |
                                        <form action="{{ route('backend.kas_mingguan.destroy', $data->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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

