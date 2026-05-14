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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mahasiswa_id')
                ->constrained('mahasiswa')
                ->onDelete('cascade');

            $table->foreignId('universitas_id')
                ->constrained('universitas')
                ->onDelete('cascade');

            $table->foreignId('jurusan_id')
                ->constrained('jurusan')
                ->onDelete('cascade');

            $table->string('kode_pendaftaran')->unique();

            $table->date('tanggal_daftar');

            $table->enum('status', [
                'draft',
                'pending',
                'diverifikasi',
                'ditolak',
                'diterima'
            ])->default('draft');

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
