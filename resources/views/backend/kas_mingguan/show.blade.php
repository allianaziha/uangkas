@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Detail Kas Mingguan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Kiri --}}
                        <div class="col-md-6">
                            <h6>Nama Siswa:</h6>
                            <p>{{ $kas->user->name }}</p>

                            <h6>Minggu ke:</h6>
                            <p>{{ $kas->minggu_ke }}</p>

                            <h6>Bulan:</h6>
                            <p>{{ $kas->bulan }}</p>

                            <h6>Status:</h6>
                            <p>
                                @if($kas->status == 'lunas')
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-warning">Belum Lunas</span>
                                @endif
                            </p>
                        </div>

                        {{-- Kanan --}}
                        <div class="col-md-6">
                            <h6>Total Jumlah:</h6>
                            <p>{{ number_format($kas->jumlah) }}</p>

                            <h6>Tanggal Bayar Terakhir:</h6>
                            <p>{{ $kas->tanggal_bayar }}</p>

                            <h6>Riwayat Pembayaran Minggu Ini:</h6>
                            @forelse($riwayat_pembayaran as $item)
                                <div class="border rounded p-2 mb-2">
                                    <div><strong>Tanggal:</strong> {{ $item->tanggal }}</div>
                                    <div><strong>Jumlah:</strong> {{ number_format($item->jumlah) }}</div>
                                </div>
                            @empty
                                <p class="text-muted">Belum ada pembayaran</p>
                            @endforelse
                        </div>
                    </div>

                    <a href="{{ route('backend.kas_mingguan.index') }}" class="btn btn-secondary mt-3">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
