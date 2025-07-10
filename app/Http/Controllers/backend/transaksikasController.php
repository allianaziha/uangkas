<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksikas;
use Alert;

class transaksikasController extends Controller
{
    public function index()
    {
        $transaksikas = Transaksikas::latest()->get();

        $title = 'Delete Transaksi Kas!';
        $text = 'Are you sure you want to delete?';
        confirmDelete($title, $text);

        return view('backend.transaksikas.index', compact('transaksikas'));
    }

    public function create()
    {
        return view('backend.transaksikas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:pemasukkan,pengeluaran',
            'jumlah' => 'required|integer',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $transaksi = new Transaksikas();
        $transaksi->jenis = $request->jenis;
        $transaksi->jumlah = $request->jumlah;
        $transaksi->keterangan = $request->keterangan;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->save();

        toast('Data berhasil disimpan', 'success');
        return redirect()->route('backend.transaksikas.index');
    }

    public function show($id)
    {
        $transaksi = Transaksikas::findOrFail($id);
        return view('backend.transaksikas.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksikas::findOrFail($id);
        return view('backend.transaksikas.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:pemasukkan,pengeluaran',
            'jumlah' => 'required|integer',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $transaksi = Transaksikas::findOrFail($id);
        $transaksi->jenis = $request->jenis;
        $transaksi->jumlah = $request->jumlah;
        $transaksi->keterangan = $request->keterangan;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->save();

        toast('Data berhasil diedit', 'success');
        return redirect()->route('backend.transaksikas.index');
    }

    public function destroy(string $id)
    {
        $transaksi = Transaksikas::findOrFail($id);
        $transaksi->delete();

        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.transaksikas.index');
    }
}
