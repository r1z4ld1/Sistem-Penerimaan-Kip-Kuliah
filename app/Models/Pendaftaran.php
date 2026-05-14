<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function universitas()
    {
        return $this->belongsTo(Universitas::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function berkas()
    {
        return $this->hasMany(Berkas::class);
    }

    public function verifikasi()
    {
        return $this->hasOne(Verifikasi::class);
    }
}
