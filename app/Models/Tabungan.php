<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class Tabungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'pemasukan',
        'pengeluaran',
        'siswa_id',
        'tanggal',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event listener untuk menangani pembuatan tabungan baru
        static::created(function ($tabungan) {
            // Perbarui saldo siswa
            $tabungan->updateSaldoSiswa();
        });

        // Event listener untuk menangani pembaruan tabungan
        static::updated(function ($tabungan) {
            // Perbarui saldo siswa
            $tabungan->updateSaldoSiswa();
        });

        // Event listener untuk menangani penghapusan tabungan
        static::deleted(function ($tabungan) {
            // Perbarui saldo siswa
            $tabungan->updateSaldoSiswa();
        });
    }

    // Metode untuk memperbarui saldo siswa
    public function updateSaldoSiswa()
    {
        // Ambil objek siswa yang terkait dengan tabungan ini
        $siswa = $this->siswa;

        // Hitung total pemasukan dan pengeluaran dari tabungan yang terkait dengan siswa
        $totalPemasukan = $siswa->Tabungan()->sum('pemasukan');
        $totalPengeluaran = $siswa->Tabungan()->sum('pengeluaran');

        // Hitung saldo baru
        $saldo = $totalPemasukan - $totalPengeluaran;

        // Update saldo siswa
        $siswa->update(['saldo' => $saldo]);
    }

    // Relasi tabungan dengan Siswa
    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa');
    }
}
