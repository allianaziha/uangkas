<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kas_mingguan;
use App\Models\User;
use App\Models\Pembayaran; 
use Alert;

class kas_mingguanController extends Controller
{
    public function index()
    {
        $kas_mingguan = kas_mingguan::with('user')->latest()->get();

        $title = 'Delete Kas Mingguan!';
        $text = 'Are you sure you want to delete?';
        confirmDelete($title, $text);

        return view('backend.kas_mingguan.index', compact('kas_mingguan'));
    }

    public function show($id)
    {
        $kas = kas_mingguan::with('user')->findOrFail($id);

        // Cari semua pembayaran di minggu & bulan ini
        $riwayat_pembayaran = Pembayaran::where('user_id', $kas->user_id)
            ->whereMonth('tanggal', $kas->bulan)
            ->whereYear('tanggal', date('Y', strtotime($kas->tanggal_bayar)))
            ->get()
            ->filter(function ($item) use ($kas) {
                return ceil(date('j', strtotime($item->tanggal)) / 7) == $kas->minggu_ke;
            });

        return view('backend.kas_mingguan.show', compact('kas', 'riwayat_pembayaran'));
    }

    public function destroy($id)
    {
        $kas = kas_mingguan::findOrFail($id);
        $kas->delete();

        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.kas_mingguan.index');
    }
}
