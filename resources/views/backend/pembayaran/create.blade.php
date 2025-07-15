@extends('layouts.backend')

@section('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header text-dark">
                    <h5 class="mb-0">TAMBAH PEMBAYARAN</h5>
                </div>
                <div class="card-body pt-3">
                    <form action="{{ route('backend.pembayaran.store') }}" method="POST">
                        @csrf

                        {{-- User --}}
                        <div class="mb-3">
                            <label class="form-label">Nama Siswa</label>
                            <select name="user_id" class="form-select select2 @error('user_id') is-invalid @enderror">
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

@section('scripts')
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Cari nama siswa...",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endsection
