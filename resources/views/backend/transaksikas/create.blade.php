@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Transaksi Kas</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.transaksikas.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Nama User -->
                                <div class="mb-3">
                                    <label class="form-label">Nama User</label>
                                    <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                        <option value="">-- Pilih User --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <!-- Jenis Transaksi -->
                                <div class="mb-3">
                                    <label class="form-label">Jenis Transaksi</label>
                                    <select name="jenis" class="form-control @error('jenis') is-invalid @enderror">
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="pemasukkan">Pemasukkan</option>
                                        <option value="pengeluaran">Pengeluaran</option>
                                    </select>
                                    @error('jenis')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <!-- Jumlah -->
                                <div class="mb-3">
                                    <label class="form-label">Jumlah</label>
                                    <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukkan jumlah">
                                    @error('jumlah')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Keterangan -->
                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Keterangan transaksi">
                                    @error('keterangan')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <!-- Tanggal -->
                                <div class="mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror">
                                    @error('tanggal')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary ms-2">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
