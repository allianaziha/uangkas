@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row g-3">

        {{-- Akun --}}
        <div class="col">
            <div class="card text-center shadow-sm" style="background-color: #E0E7FF;">
                <div class="card-body">
                    <i class="bx bx-user fs-2 mb-2"></i>
                    <h6 class="card-title">Akun</h6>
                    <h4>{{ $totalUser }}</h4>
                </div>
            </div>
        </div>

        {{-- Pembayaran --}}
        <div class="col">
            <div class="card text-center shadow-sm" style="background-color: #FEF9C3;">
                <div class="card-body">
                    <i class="bx bx-wallet fs-2 mb-2"></i>
                    <h6 class="card-title">Pembayaran</h6>
                    <h5>Rp. {{ number_format($totalPembayaran, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>

        {{-- Pengeluaran --}}
        <div class="col">
            <div class="card text-center shadow-sm" style="background-color: #FECACA;">
                <div class="card-body">
                    <i class="bx bx-up-arrow-alt fs-2 mb-2"></i>
                    <h6 class="card-title">Pengeluaran</h6>
                    <h5>Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>

        {{-- Pemasukan --}}
        <div class="col">
            <div class="card text-center shadow-sm" style="background-color: #D1FAE5;">
                <div class="card-body">
                    <i class="bx bx-down-arrow-alt fs-2 mb-2"></i>
                    <h6 class="card-title">Pemasukan</h6>
                    <h5>Rp. {{ number_format($totalPemasukkan, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>

        {{-- Total Uang Kas --}}
        <div class="col">
            <div class="card text-center shadow-sm" style="background-color: #DBEAFE;">
                <div class="card-body">
                    <i class="bx bx-money fs-2 mb-2"></i>
                    <h6 class="card-title">Total Uang Kas</h6>
                    <h5>Rp. {{ number_format($saldoKas, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
