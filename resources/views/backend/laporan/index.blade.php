@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-fluid">
    {{-- Form Filter --}}
    <form action="{{ route('backend.export.index') }}" method="GET" class="row g-2 align-items-end mb-3">
        <div class="col-md-3">
            <label>Jenis</label>
            <select name="jenis" class="form-control">
                <option value="">-- Pilih Jenis --</option>
                <option value="kas" {{ request('jenis') == 'kas' ? 'selected' : '' }}>Kas</option>
                <option value="pemasukkan" {{ request('jenis') == 'pemasukkan' ? 'selected' : '' }}>Pemasukkan</option>
                <option value="pengeluaran" {{ request('jenis') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
            </select>
        </div>
        <div class="col-md-3">
            <label>Dari Tanggal</label>
            <input type="date" name="awal" value="{{ request('awal') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label>Sampai Tanggal</label>
            <input type="date" name="akhir" value="{{ request('akhir') }}" class="form-control">
        </div>
        <div class="col-md-3 d-flex gap-2 align-items-end">
            <button type="submit" class="btn btn-primary">Cari</button>
            <a href="{{ route('backend.export.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    {{-- Tombol Export --}}
    @if(request('jenis'))
    <div class="mb-3 d-flex gap-2 flex-wrap">
        <a href="{{ route('backend.export.index', array_merge(request()->all(), ['export' => 'excel'])) }}" class="btn btn-success">
            Export Excel
        </a>
        <a href="{{ route('backend.export.index', array_merge(request()->all(), ['export' => 'pdf'])) }}" class="btn btn-danger">
            Export PDF
        </a>
    </div>
    @endif

    @if(request()->filled('jenis'))
        {{-- Saldo Kas & Saldo Tunggakan --}}
        @if($jenis == 'kas')
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header text-dark">Saldo Kas</div>
                    <div class="card-body">
                        <p class="fw-bold">Rp. {{ number_format($saldoKas,0,',','.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header text-dark">Saldo Tunggakan</div>
                    <div class="card-body">
                        <p class="fw-bold">Rp. {{ number_format($saldoNunggak,0,',','.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header text-dark">TOTAL UANG</div>
                    <div class="card-body">
                        <p class="fw-bold">Rp. {{ number_format($totalUang,0,',','.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endif

    {{-- Tabel --}}
    @if($jenis == 'pengeluaran' || $jenis == 'pemasukkan')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Data {{ ucfirst($jenis) }}</h5>
                    <div class="table-responsive">
                        <table class="table" id="dataTransaksi">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksi as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ ucfirst($data->jenis) }}</td>
                                    <td>Rp. {{ number_format($data->jumlah,0,',','.') }}</td>
                                    <td>{{ $data->keterangan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d M Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif($jenis == 'kas')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Data Kas Mingguan</h5>
                    <div class="table-responsive border rounded-4">
                        <table class="table" id="dataKas">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Minggu Ke</th>
                                    <th>Bulan</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kas as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>
                                        @if($data->status == 'belum')
                                            <span class="badge bg-danger">Belum</span>
                                        @else
                                            <span class="badge bg-success">Lunas</span>
                                        @endif
                                    </td>
                                    <td>{{ $data->minggu_ke }}</td>
                                    <td>{{ \Carbon\Carbon::create()->month($data->bulan)->translatedFormat('F') }}</td>
                                    <td>Rp. {{ number_format($data->jumlah,0,',','.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->tanggal_bayar)->translatedFormat('d M Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection