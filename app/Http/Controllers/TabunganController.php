<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tabungan;
use App\Models\Siswa;

class TabunganController extends Controller
{
    public function index()
    {
        // Tampilkan semua data tabungan
        $tabungan = Tabungan::all();
        $title = "List Tabungan";
        return view('admin.tabungan.index', compact('tabungan', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk menambahkan data tabungan
        $siswa = Siswa::all();
        $title = "Create Tabungan";
        return view('admin.tabungan.create', compact('siswa', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diinput
        $request->validate([
            'siswa_id' => 'required',
            'pemasukan' => 'nullable|numeric',
            'pengeluaran' => 'nullable|numeric',
            'tanggal' => 'required|date',
        ]);

        // Simpan data tabungan ke database
        $tabungan = Tabungan::create($request->all());

        // Perbarui saldo siswa
        $this->updateSaldoSiswa($tabungan);

        return redirect()->route("tabungan.index")->with('success', 'Data tabungan berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tabungan $tabungan)
    {
        // Validasi data yang diinput
        $request->validate([
            'siswa_id' => 'required',
            'pemasukan' => 'nullable|numeric',
            'pengeluaran' => 'nullable|numeric',
            'tanggal' => 'required|date',
        ]);

        // Update data tabungan di database
        $tabungan->update($request->all());

        // Perbarui saldo siswa
        $this->updateSaldoSiswa($tabungan);

        return redirect()->route("tabungan.index")->with('success', 'Data tabungan berhasil diperbarui.');
    }

    /**
     * Update saldo siswa based on the provided tabungan.
     */
    private function updateSaldoSiswa(Tabungan $tabungan)
    {
        $siswa = Siswa::find($tabungan->siswa_id);

        // Hitung total pemasukan dan pengeluaran siswa
        $totalPemasukan = $siswa->tabungan()->sum('pemasukan');
        $totalPengeluaran = $siswa->tabungan()->sum('pengeluaran');

        // Hitung saldo baru
        $saldo = $totalPemasukan - $totalPengeluaran;

        // Update saldo siswa
        $siswa->update(['saldo' => $saldo]);
    }
    /**
     * Display the specified resource.
     */
    public function show(Tabungan $tabungan)
    {
        // Tampilkan detail data tabungan
        return view('admin.tabungan.show', compact('tabungan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tabungan $tabungan)
    {
        // Tampilkan form untuk mengedit data tabungan
        $siswa = Siswa::all();
        return view('admin.tabungan.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tabungan $tabungan)
    {
        // Hapus data tabungan dari database
        $tabungan->delete();

        return redirect()->route('tabungan.index')->with('success', 'Data tabungan berhasil dihapus.');
    }
}
