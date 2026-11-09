<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'nip',
        'jabatan',
        'bidang',
        'status_kepegawaian',
        'status_ketersediaan',
    ];
}