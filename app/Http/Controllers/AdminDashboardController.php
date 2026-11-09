<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JanjiTemu;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // STATISTIK TOTAL PERMOHONAN
        $totalPermohonan = JanjiTemu::count();

        // STATISTIK BERDASARKAN STATUS
        $menunggu = JanjiTemu::where('status', 'Menunggu Konfirmasi')->count();

        $diterima = JanjiTemu::where('status', 'Diterima')->count();

        $ditolak = JanjiTemu::where('status', 'Ditolak')->count();

        // GRAFIK KUNJUNGAN PER BULAN
        $dataBulanan = JanjiTemu::selectRaw('MONTH(tanggal_kunjungan) as bulan, COUNT(*) as total')
            ->whereYear('tanggal_kunjungan', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $namaBulan = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        ];

        $labelGrafik = [];
        $nilaiGrafik = [];

        foreach ($namaBulan as $nomor => $nama) {
            $labelGrafik[] = $nama;

            $data = $dataBulanan->firstWhere('bulan', $nomor);

            $nilaiGrafik[] = $data ? $data->total : 0;
        }

        return view('admin.dashboard', compact(
            'totalPermohonan',
            'menunggu',
            'diterima',
            'ditolak',
            'labelGrafik',
            'nilaiGrafik'
        ));
    }
}