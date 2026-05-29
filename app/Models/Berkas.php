<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pendaftaran;
use App\Enums\StatusBerkasEnum;
use App\Models\Mahasiswa;


class Berkas extends Model
{
    protected $fillable = [

        'pendaftaran_id',
        'nama_berkas',
        'file_berkas',
        'status_verifikasi',
        'catatan_verifikasi',

    ];
    protected $casts = [

        'status_verifikasi' => StatusBerkasEnum::class,

        'verified_at' => 'datetime',
    ];
    protected $table = 'berkas';

    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
