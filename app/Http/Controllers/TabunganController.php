<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tabungan;
use App\Models\Siswa;
use Illuminate\Support\Facades\Session;

class TabunganController extends Controller
{
    public function index()
    {
        $tabungan = Tabungan::all();
        $title = "List Tabungan";
        return view('admin.tabungan.index', compact('tabungan', 'title'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        $title = "Create Tabungan";
        return view('admin.tabungan.create', compact('siswa', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'pemasukan' => 'nullable|numeric',
            'pengeluaran' => 'nullable|numeric',
            'tanggal' => 'required|date',
        ]);

        try {
            $tabungan = Tabungan::create($request->all());
            $this->updateSaldoSiswa($tabungan);
            return redirect()->route("tabungan.index")->with('success', 'Data tabungan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route("tabungan.index")->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, Tabungan $tabungan)
    {
        $request->validate([
            'siswa_id' => 'required',
            'pemasukan' => 'nullable|numeric',
            'pengeluaran' => 'nullable|numeric',
            'tanggal' => 'required|date',
        ]);

        try {
            $tabungan->update($request->all());
            $this->updateSaldoSiswa($tabungan);
            return redirect()->route("tabungan.index")->with('success', 'Data tabungan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route("tabungan.index")->with('error', $e->getMessage());
        }
    }

    private function updateSaldoSiswa(Tabungan $tabungan)
    {
        $siswa = Siswa::find($tabungan->siswa_id);
        $totalPemasukan = $siswa->tabungan()->sum('pemasukan');
        $totalPengeluaran = $siswa->tabungan()->sum('pengeluaran');
        $saldo = $totalPemasukan - $totalPengeluaran;
        $siswa->update(['saldo' => $saldo]);
    }

    public function show(Tabungan $tabungan)
    {
        return view('admin.tabungan.show', compact('tabungan'));
    }

    public function edit(Tabungan $tabungan)
    {
        $siswa = Siswa::all();
        return view('admin.tabungan.edit', compact('tabungan', 'siswa'));
    }

    public function destroy(Tabungan $tabungan)
    {
        try {
            $tabungan->delete();
            return redirect()->route('tabungan.index')->with('success', 'Data tabungan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route("tabungan.index")->with('error', $e->getMessage());
        }
    }
}
