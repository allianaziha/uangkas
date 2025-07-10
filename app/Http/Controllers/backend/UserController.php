<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('isAdmin', '!=', 1)->get();
        $title = 'Hapus Data Akun!';
        $text  = "Apakah Anda Yakin??";
        confirmDelete($title, $text);

        return view('backend.siswa.index', compact('users'));
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