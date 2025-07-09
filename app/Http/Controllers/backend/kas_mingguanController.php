<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kas_mingguan;
use App\Models\User;
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

    public function create()
    {
        $users = User::all();
        return view('backend.kas_mingguan.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:lunas,belum',
            'minggu_ke' => 'required|integer',
            'bulan' => 'required|integer',
            'jumlah' => 'required|integer',
            'tanggal_bayar' => 'required|date',
        ]);

        $kas = new kas_mingguan();
        $kas->user_id = $request->user_id;
        $kas->status = $request->status;
        $kas->minggu_ke = $request->minggu_ke;
        $kas->bulan = $request->bulan;
        $kas->jumlah = $request->jumlah;
        $kas->tanggal_bayar = $request->tanggal_bayar;
        $kas->save();

        toast('Data berhasil disimpan', 'success');
        return redirect()->route('backend.kas_mingguan.index');
    }

    public function edit($id)
    {
        $kas = kas_mingguan::findOrFail($id);
        $users = User::all();
        return view('backend.kas_mingguan.edit', compact('kas', 'users'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:lunas,belum',
            'minggu_ke' => 'required|integer',
            'bulan' => 'required|integer',
            'jumlah' => 'required|integer',
            'tanggal_bayar' => 'required|date',
        ]);

        $kas = kas_mingguan::findOrFail($id);
        $kas->user_id = $request->user_id;
        $kas->status = $request->status;
        $kas->minggu_ke = $request->minggu_ke;
        $kas->bulan = $request->bulan;
        $kas->jumlah = $request->jumlah;
        $kas->tanggal_bayar = $request->tanggal_bayar;
        $kas->save();

        toast('Data berhasil diedit', 'success');
        return redirect()->route('backend.kas_mingguan.index');
    }

    public function destroy($id)
    {
        $kas = kas_mingguan::findOrFail($id);
        $kas->delete();

        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.kas_mingguan.index');
    }
}
