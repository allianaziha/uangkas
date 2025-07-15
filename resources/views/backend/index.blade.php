@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row g-3">
        {{-- Akun --}}
        <div class="col">
            <div class="card text-center shadow-sm" style="background-color: #EFF6FF;">
                <div class="card-body">
                    <i class="bx bx-user fs-1 mb-2 text-primary"></i>
                    <h6 class="card-title text-secondary">Akun</h6>
                    <h4 class="fw-bold">{{ $totalUser }}</h4>
                </div>
            </div>
        </div>
        {{-- Pembayaran --}}
        <div class="col">
            <div class="card text-center shadow-sm" style="background-color: #FEF9C3;">
                <div class="card-body">
                    <i class="bx bx-wallet fs-1 mb-2 text-warning"></i>
                    <h6 class="card-title text-secondary">Pembayaran</h6>
                    <h5 class="fw-bold">Rp. {{ number_format($totalPembayaran, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
        {{-- Pemasukan --}}
        <div class="col">
            <div class="card text-center shadow-sm" style="background-color: #DCFCE7;">
                <div class="card-body">
                    <i class="bx bx-down-arrow-alt fs-1 mb-2 text-success"></i>
                    <h6 class="card-title text-secondary">Pemasukan</h6>
                    <h5 class="fw-bold">Rp. {{ number_format($totalPemasukkan, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
        {{-- Pengeluaran --}}
        <div class="col">
            <div class="card text-center shadow-sm" style="background-color: #FEE2E2;">
                <div class="card-body">
                    <i class="bx bx-up-arrow-alt fs-1 mb-2 text-danger"></i>
                    <h6 class="card-title text-secondary">Pengeluaran</h6>
                    <h5 class="fw-bold">Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
        {{-- Saldo --}}
        <div class="col">
            <div class="card text-center shadow-sm" style="background-color: #DBEAFE;">
                <div class="card-body">
                    <i class="bx bx-money fs-1 mb-2 text-primary"></i>
                    <h6 class="card-title text-secondary">Total Uang Kas</h6>
                    <h5 class="fw-bold">Rp. {{ number_format($saldoKas, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


