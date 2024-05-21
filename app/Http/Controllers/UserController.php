<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna.
     */
    public function index()
    {
        $title = 'Manajemen Pengguna';
        $user = User::all();
        return view('admin.users.index', compact('user', 'title'));
    }

    /**
     * Menampilkan formulir untuk membuat pengguna baru.
     */
    public function create()
    {
        $title = 'Buat Pengguna';
        return view('admin.users.create', compact('title'));
    }

    /**
     * Menyimpan pengguna baru ke dalam penyimpanan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'user',
                'password' => Hash::make($request->password),
            ]);

            Session::flash('success', 'Pengguna berhasil dibuat.');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }

        return redirect()->route('users.index');
    }

    /**
     * Menampilkan detail pengguna tertentu.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $title = 'Detail Pengguna';
        return view('admin.users.show', compact('user', 'title'));
    }

    /**
     * Menampilkan formulir untuk mengedit pengguna tertentu.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $title = 'Edit Pengguna';
        return view('admin.users.edit', compact('user', 'title'));
    }

    /**
     * Memperbarui pengguna tertentu di dalam penyimpanan.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string|in:user,admin', // Tambahkan validasi untuk role
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role; // Update role sesuai permintaan
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            Session::flash('success', 'Pengguna berhasil diperbarui.');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }

        return redirect()->route('users.index');
    }

    /**
     * Menghapus pengguna tertentu dari penyimpanan.
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            Session::flash('success', 'Pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }

        return redirect()->route('users.index');
    }
}
