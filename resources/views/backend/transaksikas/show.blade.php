@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    Detail Transaksi Kas
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama User</label>
                                <div class="form-control-plaintext">
                                    {{ $transaksi->user->name }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Jenis Transaksi</label>
                                <div class="form-control-plaintext text-capitalize">
                                    {{ $transaksi->jenis }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Jumlah</label>
                                <div class="form-control-plaintext">
                                    Rp{{ number_format($transaksi->jumlah,0,',','.') }}
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Keterangan</label>
                                <div class="form-control-plaintext">
                                    {{ $transaksi->keterangan }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tanggal</label>
                                <div class="form-control-plaintext">
                                    {{ date('d-m-Y', strtotime($transaksi->tanggal)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('backend.transaksikas.index') }}" class="btn btn-sm btn-outline-secondary">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
