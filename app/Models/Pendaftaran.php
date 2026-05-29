<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Berkas;
use App\Models\Mahasiswa;
use App\Models\Universitas;
use App\Models\Jurusan;
use App\Models\Verifikasi;

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
