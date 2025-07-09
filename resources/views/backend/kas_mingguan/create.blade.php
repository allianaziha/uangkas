@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-secondary">
                    Tambah Kas Mingguan
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.kas_mingguan.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label for="">Nama User</label>
                                    <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="lunas">Lunas</option>
                                        <option value="belum">Belum</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="">Minggu Ke</label>
                                    <input type="number" name="minggu_ke" class="form-control @error('minggu_ke') is-invalid @enderror">
                                    @error('minggu_ke')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="">Bulan</label>
                                    <input type="number" name="bulan" class="form-control @error('bulan') is-invalid @enderror">
                                    @error('bulan')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label for="">Jumlah</label>
                                    <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror">
                                    @error('jumlah')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="">Tanggal Bayar</label>
                                    <input type="date" name="tanggal_bayar" class="form-control @error('tanggal_bayar') is-invalid @enderror">
                                    @error('tanggal_bayar')
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
