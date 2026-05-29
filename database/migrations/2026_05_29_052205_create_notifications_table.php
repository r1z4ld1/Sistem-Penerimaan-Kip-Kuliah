<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (
            Blueprint $table
        ) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | user penerima notifikasi
            |--------------------------------------------------------------------------
            */
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | isi notifikasi
            |--------------------------------------------------------------------------
            */
            $table->string('title');

            $table->text('message');

            /*
            |--------------------------------------------------------------------------
            | type
            |--------------------------------------------------------------------------
            */
            $table->string('type');

            /*
            |--------------------------------------------------------------------------
            | status baca
            |--------------------------------------------------------------------------
            */
            $table->boolean('is_read')
                ->default(false);

            $table->timestamp('read_at')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'notifications'
        );
    }
};
