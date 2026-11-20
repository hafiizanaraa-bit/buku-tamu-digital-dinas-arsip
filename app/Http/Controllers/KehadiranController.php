<?php

namespace App\Http\Controllers;

use App\Models\KehadiranPegawai;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');

        $hariIni = Carbon::today();

        // Sabtu/Minggu: tampilkan minggu depan agar tab hari kerja tidak kosong
        $basis = $hariIni->isWeekend()
            ? $hariIni->copy()->next(Carbon::MONDAY)
            : $hariIni->copy();

        $awalMinggu = $basis->copy()->startOfWeek();

        $hari = collect(range(0, 4))
            ->map(fn ($i) => $awalMinggu->copy()->addDays($i));

        try {
            $tanggal = $request->filled('tanggal')
                ? Carbon::parse($request->tanggal)->startOfDay()
                : $basis->copy();
        } catch (\Throwable $e) {
            $tanggal = $basis->copy();
        }

        $pegawais = Pegawai::orderBy('nama_lengkap')->get();

        $kehadiran = KehadiranPegawai::whereDate('tanggal', $tanggal->toDateString())
            ->get()
            ->keyBy('pegawai_id');

        $jam = KehadiranPegawai::jamOperasional($tanggal);

        return view('kehadiran.index', compact(
            'pegawais',
            'kehadiran',
            'tanggal',
            'hari',
            'hariIni',
            'jam'
        ));
    }
}
