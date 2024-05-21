<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tabungans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("siswa_id");
            $table->integer("pemasukan")->nullable();
            $table->integer("pengeluaran")->nullable();
            $table->date("tanggal");
            $table->timestamps();

            $table->foreign("siswa_id")->references("id")->on("siswas")->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabungans');
    }
};
