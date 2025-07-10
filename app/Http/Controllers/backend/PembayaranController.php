<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\kas_mingguan;
use App\Models\User;
use Alert;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('user')->latest()->get();

        $title = 'Hapus Data!';
        $text = 'Yakin ingin menghapus data ini?';
        confirmDelete($title, $text);

        return view('backend.pembayaran.index', compact('pembayarans'));
    }

    public function create()
    {
        $users = User::all();
        return view('backend.pembayaran.create', compact('users'));
    }

   public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'   => 'required|exists:users,id',
            'jumlah'    => 'required|integer',
            'tanggal'   => 'required|date',
        ]);

        // Simpan ke tabel pembayaran
        $pembayaran = Pembayaran::create([
            'user_id' => $validated['user_id'],
            'jumlah'  => $validated['jumlah'],
            'tanggal' => $validated['tanggal'],
        ]);

        // Hitung minggu_ke dan bulan
        $tanggal = strtotime($validated['tanggal']);
        $minggu_ke = ceil(date('j', $tanggal) / 7);
        $bulan = date('n', $tanggal);

        // Total pembayaran di minggu itu oleh user tsb
        $total_mingguan = Pembayaran::where('user_id', $validated['user_id'])
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', date('Y', $tanggal))
            ->get()
            ->filter(function ($item) use ($minggu_ke) {
                return ceil(date('j', strtotime($item->tanggal)) / 7) == $minggu_ke;
            })
            ->sum('jumlah');

        // Cek status: lunas jika total pembayaran minggu itu >= 10000
        $status = $total_mingguan >= 10000 ? 'lunas' : 'belum';

        // Cek apakah sudah ada data minggu ke sekian
        $kas = kas_mingguan::where('user_id', $validated['user_id'])
            ->where('minggu_ke', $minggu_ke)
            ->where('bulan', $bulan)
            ->first();

        if ($kas) {
            $kas->update([
                'jumlah'        => $total_mingguan,
                'status'        => $status,
                'tanggal_bayar' => $validated['tanggal'],
            ]);
        } else {
            kas_mingguan::create([
                'user_id'       => $validated['user_id'],
                'minggu_ke'     => $minggu_ke,
                'bulan'         => $bulan,
                'status'        => $status,
                'jumlah'        => $total_mingguan,
                'tanggal_bayar' => $validated['tanggal'],
            ]);
        }

        toast('Pembayaran dan Kas Mingguan berhasil disimpan', 'success');
        return redirect()->route('backend.pembayaran.index');
    }


    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $users = User::all();
        return view('backend.pembayaran.edit', compact('pembayaran', 'users'));
    }

   public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id'   => 'required|exists:users,id',
            'jumlah'    => 'required|integer',
            'tanggal'   => 'required|date',
        ]);

        // Update Pembayaran
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update([
            'user_id' => $validated['user_id'],
            'jumlah'  => $validated['jumlah'],
            'tanggal' => $validated['tanggal'],
        ]);

        // Tentukan status baru
        $status = $validated['jumlah'] >= 10000 ? 'lunas' : 'belum';

        // Update Kas Mingguan yang berkaitan
        $kas = kas_mingguan::where('user_id', $validated['user_id'])
            ->whereDate('tanggal_bayar', $validated['tanggal'])
            ->first();

        if ($kas) {
            $kas->update([
                'jumlah' => $validated['jumlah'],
                'status' => $status,
            ]);
        }

        toast('Data pembayaran berhasil diperbarui dan status kas mingguan diperbarui', 'success');
        return redirect()->route('backend.pembayaran.index');
    }


   public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $user_id = $pembayaran->user_id;
        $tanggal = strtotime($pembayaran->tanggal);
        $minggu_ke = ceil(date('j', $tanggal) / 7);
        $bulan = date('n', $tanggal);

        // Hapus pembayaran
        $pembayaran->delete();

        // Hitung ulang total pembayaran minggu itu
        $total_mingguan = Pembayaran::where('user_id', $user_id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', date('Y', $tanggal))
            ->get()
            ->filter(function ($item) use ($minggu_ke) {
                return ceil(date('j', strtotime($item->tanggal)) / 7) == $minggu_ke;
            })
            ->sum('jumlah');

        $status = $total_mingguan >= 10000 ? 'lunas' : 'belum';

        // Update/hapus kas mingguan
        $kas = kas_mingguan::where('user_id', $user_id)
            ->where('minggu_ke', $minggu_ke)
            ->where('bulan', $bulan)
            ->first();

        if ($kas) {
            if ($total_mingguan > 0) {
                $kas->update([
                    'jumlah' => $total_mingguan,
                    'status' => $status,
                ]);
            } else {
                $kas->delete(); // tidak ada pembayaran lagi → hapus kas mingguannya
            }
        }

        toast('Data berhasil dihapus dan kas mingguan diperbarui', 'success');
        return redirect()->route('backend.pembayaran.index');
    }
}
