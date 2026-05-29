<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Pendaftaran;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }
    public function berkas()
    {
        return $this->hasMany(Berkas::class);
    }
}
