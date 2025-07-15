<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\kas_mingguan;
use App\Models\transaksikas;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function index(Request $request)
    {
        // Hitung saldo total pemasukkan, pengeluaran, pembayaran
        $totalPemasukkan  = transaksikas::where('jenis', 'pemasukkan')->sum('jumlah');
        $totalPengeluaran = transaksikas::where('jenis', 'pengeluaran')->sum('jumlah');
        $totalPembayaran  = Pembayaran::sum('jumlah');

        $saldoKas = $totalPembayaran + $totalPemasukkan - $totalPengeluaran;

        $saldoNunggak = kas_mingguan::where('status', 'belum')
            ->get()
            ->sum(function ($kas) {
                return 10000 - $kas->jumlah;
            });

        // Ambil filter
        $jenis = $request->jenis;
        $awal  = $request->awal;
        $akhir = $request->akhir;

        $kas        = collect();
        $transaksi  = collect();
        $totalUang  = null;

        // Filter data sesuai jenis
        if ($jenis === 'kas') {
            $kasQuery = kas_mingguan::with('user');
            if ($awal && $akhir) {
                $kasQuery->whereBetween('tanggal_bayar', [$awal, $akhir]);
            }
            $kas = $kasQuery->get();

        } elseif ($jenis === 'pemasukkan' || $jenis === 'pengeluaran') {
            $trxQuery = transaksikas::where('jenis', $jenis);
            if ($awal && $akhir) {
                $trxQuery->whereBetween('tanggal', [$awal, $akhir]);
            }
            $transaksi = $trxQuery->get();
            $totalUang = $transaksi->sum('jumlah');
        }

        // Export Excel
        if ($request->export == 'excel') {
            return response()->view('backend.laporan.export_excel', compact(
                'kas',
                'jenis',
                'transaksi',
                'saldoKas',
                'saldoNunggak'
            ))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename=laporan_kas.xls');
        }

        // Export PDF
        if ($request->export == 'pdf') {
            $pdf = Pdf::loadView('backend.laporan.export_pdf', compact(
                'kas',
                'jenis',
                'transaksi',
                'saldoKas',
                'saldoNunggak',
                'totalUang'
            ));
            return $pdf->download('laporan_kas.pdf');
        }

        // Tampilkan halaman laporan biasa
        return view('backend.laporan.index', compact(
            'kas',
            'transaksi',
            'jenis',
            'saldoKas',
            'saldoNunggak',
            'totalUang'
        ));
    }
}