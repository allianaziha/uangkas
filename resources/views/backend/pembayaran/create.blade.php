@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Pembayaran</h5>
                </div>
                <div class="card-body pt-3">
                    <form action="{{ route('backend.pembayaran.store') }}" method="POST">
                        @csrf

                        {{-- User --}}
                        <div class="form-floating mb-3">
                            <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                <option value="">-- Pilih Siswa --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                            <label>Nama Siswa</label>
                        </div>

                        {{-- Jumlah --}}
                        <div class="form-floating mb-3">
                            <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukkan jumlah" value="{{ old('jumlah') }}">
                            @error('jumlah')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                            <label>Jumlah Pembayaran</label>
                        </div>

                        {{-- Tanggal --}}
                        <div class="form-floating mb-3">
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}">
                            @error('tanggal')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                            <label>Tanggal Pembayaran</label>
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
