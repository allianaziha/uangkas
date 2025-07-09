<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
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

        return redirect()->route('backend.siswa.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('backend.siswa.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('backend.siswa.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('backend.siswa.index')->with('success', 'User berhasil dihapus');
    }

}