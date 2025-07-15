<?php
namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\kas_mingguan;
use Illuminate\Http\Request;
use Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        foreach ($users as $user) {
            // Misalnya semester 1: bulan 1–6
            $jumlahBayar = kas_mingguan::where('user_id', $user->id)
                ->whereBetween('bulan', [1, 12])
                ->where('status', 'lunas')
                ->count();

            $totalMinggu = 12 * 4; // misalnya 12 bulan × 4 minggu = 48
            $persen      = $totalMinggu > 0 ? ($jumlahBayar / $totalMinggu) * 100 : 0;

            if ($jumlahBayar == 0) {
                $status = 'Tidak Pernah';
            } elseif ($persen >= 60) {
                $status = 'Rajin';
            } elseif ($persen >= 20) {
                $status = 'Kadang-kadang';
            } else {
                $status = 'Jarang';
            }

            // Tambah properti sementara ke objek user
            $user->status_semester = $status;
        }


        $title = 'Hapus Data Akun!';
        $text  = "Apakah Anda Yakin??";
        confirmDelete($title, $text);

        return view('backend.siswa.index', compact('users', 'persen'));
    }


    public function create()
    {
        return view('backend.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        toast('Data berhasil ditambahkan', 'success');
        return redirect()->route('backend.siswa.index');
    }

    public function show()
    {

    }

    public function edit($id)
    {
        $siswa = User::findOrFail($id);
        return view('backend.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        toast('Data berhasil diedit', 'success');
        return redirect()->route('backend.siswa.index');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.siswa.index');
    }
}
