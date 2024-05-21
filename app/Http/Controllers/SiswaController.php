<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Session;

class SiswaController extends Controller
{
    /**
     * Menampilkan daftar siswa.
     */
    public function index()
    {
        $title = 'List Siswa';
        $siswa = Siswa::all();
        return view('admin.siswa.index', compact('siswa', 'title'));
    }

    /**
     * Menampilkan formulir untuk membuat siswa baru.
     */
    public function create()
    {
        $title = 'Tambah Data';
        return view('admin.siswa.create', compact('title'));
    }

    /**
     * Menyimpan siswa baru ke dalam penyimpanan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'saldo' => 'required|numeric',
        ]);

        try {
            $siswa = new Siswa();
            $siswa->nama_siswa = $request->nama_siswa;
            $siswa->saldo = $request->saldo;
            $siswa->save();
            Session::flash('sukses', 'Data Berhasil Ditambah');
        } catch (\Exception $e) {
            Session::flash('gagal', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->route('siswa.index');
    }

    /**
     * Menampilkan detail siswa tertentu.
     */
    public function show(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $title = 'Detail Siswa';
        return view('admin.siswa.show', compact('siswa', 'title'));
    }

    /**
     * Menampilkan formulir untuk mengedit siswa tertentu.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $title = 'Edit Data';
        return view('admin.siswa.edit', compact('siswa', 'title'));
    }

    /**
     * Memperbarui siswa tertentu di dalam penyimpanan.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'saldo' => 'required|numeric',
        ]);

        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->nama_siswa = $request->nama_siswa;
            $siswa->saldo = $request->saldo;
            $siswa->save();
            Session::flash('sukses', 'Data Berhasil Diperbarui');
        } catch (\Exception $e) {
            Session::flash('gagal', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->route('siswa.index');
    }

    /**
     * Menghapus siswa tertentu dari penyimpanan.
     */
    public function destroy(string $id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->delete();
            Session::flash('sukses', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            Session::flash('gagal', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->route('siswa.index');
    }
}
