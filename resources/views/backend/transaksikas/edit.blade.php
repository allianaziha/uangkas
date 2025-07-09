@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-secondary">
                    Edit Transaksi Kas
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.transaksikas.update', $transaksi->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label for="">Nama User</label>
                                    <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $user->id == $transaksi->user_id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="">Jenis Transaksi</label>
                                    <select name="jenis" class="form-control @error('jenis') is-invalid @enderror">
                                        <option value="pemasukkan" {{ $transaksi->jenis == 'pemasukkan' ? 'selected' : '' }}>Pemasukkan</option>
                                        <option value="pengeluaran" {{ $transaksi->jenis == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                                    </select>
                                    @error('jenis')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="">Jumlah</label>
                                    <input type="number" name="jumlah" value="{{ $transaksi->jumlah }}"
                                        class="form-control @error('jumlah') is-invalid @enderror">
                                    @error('jumlah')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="">Keterangan</label>
                                    <input type="text" name="keterangan" value="{{ $transaksi->keterangan }}"
                                        class="form-control @error('keterangan') is-invalid @enderror">
                                    @error('keterangan')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="">Tanggal</label>
                                    <input type="date" name="tanggal" value="{{ $transaksi->tanggal }}"
                                        class="form-control @error('tanggal') is-invalid @enderror">
                                    @error('tanggal')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-sm btn-outline-primary">Simpan</button>
                            <button type="reset" class="btn btn-sm btn-outline-warning">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
