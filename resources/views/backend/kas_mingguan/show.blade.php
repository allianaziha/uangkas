@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                {{-- Header --}}
                <div class="card-header bg-primary text-white mb-4">
                    <h5 class="mb-0">Detail Kas Mingguan</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        {{-- Kiri --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong>Nama Siswa:</strong></label>
                                <div>{{ $kas->user->name }}</div>
                            </div>

                            <div class="mb-3">
                                <label><strong>Minggu ke:</strong></label>
                                <div>{{ $kas->minggu_ke }}</div>
                            </div>

                            <div class="mb-3">
                                <label><strong>Bulan:</strong></label>
                                <div>{{ \Carbon\Carbon::create()->month($kas->bulan)->translatedFormat('F') }}</div>
                            </div>

                            <div class="mb-3">
                                <label><strong>Status:</strong></label>
                                <div>
                                    @if($kas->status == 'lunas')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-warning">Belum Lunas</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Kanan --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong>Total Jumlah:</strong></label>
                                <div>Rp. {{ number_format($kas->jumlah) }}</div>
                            </div>

                            <div class="mb-3">
                                <label><strong>Tanggal Bayar Terakhir:</strong></label>
                                <div>{{ $kas->tanggal_bayar }}</div>
                            </div>

                            <div class="mb-3">
                                <label><strong>Riwayat Pembayaran Minggu Ini:</strong></label>
                                @forelse($riwayat_pembayaran as $item)
                                    <div class="mb-1">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }} 
                                        (Rp. {{ number_format($item->jumlah) }})
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">Belum ada pembayaran</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('backend.kas_mingguan.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
