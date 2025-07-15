<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Transaksikas;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class backendController extends Controller
{
    public function index()
    {
        // Total akun
        $totalUser = User::count();

        // Total pemasukan & pengeluaran dari transaksi kas
        $totalPemasukkan = Transaksikas::where('jenis', 'pemasukkan')->sum('jumlah');
        $totalPengeluaran = Transaksikas::where('jenis', 'pengeluaran')->sum('jumlah');

        // Total pembayaran siswa
        $totalPembayaran = Pembayaran::sum('jumlah');

        // Saldo akhir
        $saldoKas = $totalPembayaran + $totalPemasukkan - $totalPengeluaran;

        // Pemasukan per bulan dari TransaksiKas
        $pemasukanPerBulan = Transaksikas::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('SUM(jumlah) as total')
            )
            ->where('jenis', 'pemasukkan')
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->pluck('total', 'bulan');

        // Pemasukan per bulan dari Pembayaran
        $pembayaranPerBulan = Pembayaran::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('SUM(jumlah) as total')
            )
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->pluck('total', 'bulan');

        // Pengeluaran per kategori
        $pengeluaranKategori = Transaksikas::select(
                'keterangan',
                DB::raw('SUM(jumlah) as total')
            )
            ->where('jenis', 'pengeluaran')
            ->groupBy('keterangan')
            ->pluck('total', 'keterangan');

        return view('backend.index', compact(
            'totalUser',
            'totalPemasukkan',
            'totalPengeluaran',
            'totalPembayaran',
            'saldoKas',
            'pemasukanPerBulan',
            'pembayaranPerBulan',
            'pengeluaranKategori'
        ));
    }
}
