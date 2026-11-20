<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class KehadiranPegawai extends Model
{
    protected $table = 'kehadiran_pegawais';

    protected $fillable = [
        'pegawai_id',
        'tanggal',
        'status',
        'jam_masuk',
        'jam_pulang',
        'keterangan',
        'bukti',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public const STATUS = [
        'hadir'       => 'Ada di ruangan',
        'tidak_hadir' => 'Tidak ada di ruangan',
        'dinas_luar'  => 'Dinas luar',
        'izin'        => 'Izin',
        'cuti'        => 'Cuti',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function getLabelStatusAttribute(): string
    {
        return self::STATUS[$this->status] ?? (string) $this->status;
    }

    /** Teks jam, misalnya "07:45 - 15:40" atau "sejak 07:45" */
    public function getJamAttribute(): string
    {
        $masuk  = $this->jam_masuk ? substr((string) $this->jam_masuk, 0, 5) : null;
        $pulang = $this->jam_pulang ? substr((string) $this->jam_pulang, 0, 5) : null;

        if ($masuk && $pulang) {
            return $masuk . ' - ' . $pulang . ' WIB';
        }

        if ($masuk) {
            return 'sejak ' . $masuk . ' WIB';
        }

        return '';
    }

    /**
     * Jam operasional:
     * Senin - Kamis 07.30 - 15.30, Jumat 07.30 - 16.00
     * Sabtu & Minggu libur (null).
     */
    public static function jamOperasional(Carbon $tanggal): ?array
    {
        switch ($tanggal->dayOfWeekIso) {
            case 1:
            case 2:
            case 3:
            case 4:
                return ['buka' => '07.30', 'tutup' => '15.30'];
            case 5:
                return ['buka' => '07.30', 'tutup' => '16.00'];
            default:
                return null;
        }
    }
}
