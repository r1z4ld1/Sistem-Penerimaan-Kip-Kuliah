<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Mouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Universitas extends Model
{
    protected $table = 'universitas';

    protected $guarded = [];

    public function jurusan()
    {
        return $this->hasMany(Jurusan::class);
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
