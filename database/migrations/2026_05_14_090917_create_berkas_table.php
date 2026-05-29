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
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pendaftaran_id')
                ->constrained('pendaftaran')
                ->onDelete('cascade');


            $table->string('nama_berkas');
            $table->string('file_berkas');

            $table->enum('status_verifikasi', [
                'pending',
                'diterima',
                'ditolak'
            ])->default('pending');
            $table->text('catatan_verifikasi')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas');
    }
};
