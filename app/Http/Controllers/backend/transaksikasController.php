<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksikas;
use App\Models\User;
use Alert;

class transaksikasController extends Controller
{
    public function index()
    {
        $transaksikas = Transaksikas::with('user')->latest()->get();

        $title = 'Delete Transaksi Kas!';
        $text = 'Are you sure you want to delete?';
        confirmDelete($title, $text);

        return view('backend.transaksikas.index', compact('transaksikas'));
    }

    public function create()
    {
        $users = User::all();
        return view('backend.transaksikas.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis' => 'required|in:pemasukkan,pengeluaran',
            'jumlah' => 'required|integer',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $transaksi = new Transaksikas();
        $transaksi->user_id = $request->user_id;
        $transaksi->jenis = $request->jenis;
        $transaksi->jumlah = $request->jumlah;
        $transaksi->keterangan = $request->keterangan;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->save();

        toast('Data berhasil disimpan', 'success');
        return redirect()->route('backend.transaksikas.index');
    }

    public function edit($id)
    {
        $transaksi = Transaksikas::findOrFail($id);
        $users = User::all();
        return view('backend.transaksikas.edit', compact('transaksi', 'users'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis' => 'required|in:pemasukkan,pengeluaran',
            'jumlah' => 'required|integer',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $transaksi = Transaksikas::findOrFail($id);
         $transaksi->user_id = $request->user_id;
        $transaksi->jenis = $request->jenis;
        $transaksi->jumlah = $request->jumlah;
        $transaksi->keterangan = $request->keterangan;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->save();

        toast('Data berhasil diedit', 'success');
        return redirect()->route('backend.transaksikas.index');
    }

    public function show($id)
    {
        $transaksi = Transaksikas::with('user')->findOrFail($id);
        return view('backend.transaksikas.show', compact('transaksi'));
    }

    public function destroy($id)
    {
        $transaksi = Transaksikas::findOrFail($id);
        $transaksi->delete();

        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.transaksikas.index');
    }
}
