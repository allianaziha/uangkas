<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Transaksikas;
use Auth;

class FrontendController extends Controller
{
    public function index()
    {
        // Hitung total pemasukkan dan pengeluaran dari tabel transaksikas
        $totalPemasukkan  = Transaksikas::where('jenis', 'pemasukkan')->sum('jumlah');
        $totalPengeluaran = Transaksikas::where('jenis', 'pengeluaran')->sum('jumlah');

        // Total pembayaran dari tabel pembayaran
        $totalPembayaran = Pembayaran::sum('jumlah');

        // Saldo akhir
        $saldoKas = $totalPembayaran + $totalPemasukkan - $totalPengeluaran;

        // Ambil data pengeluaran saja
        $transaksi = Transaksikas::where('jenis', 'pengeluaran')->orderBy('tanggal', 'desc')->get();

        // Kirim data ke view index
        return view('welcome', compact(
            'totalPemasukkan',
            'totalPengeluaran',
            'totalPembayaran',
            'saldoKas',
            'transaksi'
        ));
    }

    public function profil()
    {
        $user = auth()->user();
        $totalBayar = Pembayaran::where('user_id', $user->id)->sum('jumlah');

        return view('profil', compact('user', 'totalBayar'));
    }   
}
