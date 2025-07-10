@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Edit Transaksi Kas</h5>
                </div>
                <div class="card-body pt-3">
                    <form action="{{ route('backend.transaksikas.update', $transaksi->id) }}" method="POST">
                        @method('PUT')
                        @csrf

                        {{-- Jenis Transaksi --}}
                        <div class="form-floating mb-3">
                            <select name="jenis" class="form-select @error('jenis') is-invalid @enderror">
                                <option value="">-- Pilih Jenis --</option>
                                <option value="pemasukkan" {{ $transaksi->jenis == 'pemasukkan' ? 'selected' : '' }}>Pemasukkan</option>
                                <option value="pengeluaran" {{ $transaksi->jenis == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                            @error('jenis')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                            <label>Jenis Transaksi</label>
                        </div>

                        {{-- Jumlah --}}
                        <div class="form-floating mb-3">
                            <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" placeholder="Jumlah" value="{{ old('jumlah', $transaksi->jumlah) }}">
                            @error('jumlah')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                            <label>Jumlah</label>
                        </div>

                        {{-- Keterangan --}}
                        <div class="form-floating mb-3">
                            <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Keterangan" value="{{ old('keterangan', $transaksi->keterangan) }}">
                            @error('keterangan')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                            <label>Keterangan</label>
                        </div>

                        {{-- Tanggal --}}
                        <div class="form-floating mb-3">
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" placeholder="Tanggal" value="{{ old('tanggal', $transaksi->tanggal) }}">
                            @error('tanggal')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                            <label>Tanggal</label>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary ms-2">
                                <i class="ti ti-send fs-4"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
