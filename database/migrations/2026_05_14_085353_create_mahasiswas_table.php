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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('nama');
            $table->string('nik')->unique();
            $table->string('nisn')->unique();

            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');

            $table->enum('jenis_kelamin', ['L', 'P']);

            $table->text('alamat');
            $table->string('no_hp');

            $table->string('sekolah');
            $table->year('tahun_lulus');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
