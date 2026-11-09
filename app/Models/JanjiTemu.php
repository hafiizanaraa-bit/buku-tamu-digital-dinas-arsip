<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JanjiTemu extends Model
{
    protected $fillable = [
        'kode_kunjungan',
        'nama_tamu',
        'telepon',
        'alamat',
        'instansi',
        'pegawai_id',
        'tujuan',
        'tanggal_kunjungan',
        'waktu_kunjungan',
        'catatan',
        'status',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}