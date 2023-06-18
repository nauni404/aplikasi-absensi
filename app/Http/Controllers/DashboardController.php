<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Absensi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function guru()
    {
        // Jadwal Guru Hari Ini
        $guruId = auth()->user()->guru->id;
        $hariIni = Carbon::now('Asia/Jakarta')->locale('id')->isoFormat('dddd');

        // Mendapatkan jadwal guru hari ini
        $jadwalHariIni = Jadwal::where('guru_id', $guruId)
            ->where('hari', $hariIni)
            ->with('kelas')
            ->orderBy('jam_mulai', 'asc') // Mengurutkan jadwal berdasarkan jam_mulai terkecil
            ->get();

        // Mendapatkan semua jadwal guru yang sedang login
        $jadwalGuru = Jadwal::where('guru_id', $guruId)
            ->with(['guru', 'mapel', 'kelas'])
            ->orderByRaw("CASE
                WHEN hari = 'Senin' THEN 1
                WHEN hari = 'Selasa' THEN 2
                WHEN hari = 'Rabu' THEN 3
                WHEN hari = 'Kamis' THEN 4
                WHEN hari = 'Jumat' THEN 5
                WHEN hari = 'Sabtu' THEN 6
                WHEN hari = 'Minggu' THEN 7
                ELSE 8
            END")
            ->orderBy('jam_mulai')
            ->where('hari', '>=', $hariIni)
            ->get();

        $totalKelas = $jadwalGuru->groupBy('kelas_id')->count();
        $totalSiswa = $jadwalGuru->flatMap(function ($jadwal) {
                return $jadwal->kelas->siswa;
            })->unique('id')->count();

        return view('guru.dashboard', compact('jadwalHariIni', 'jadwalGuru', 'totalKelas', 'totalSiswa'));
    }

    public function siswa()
    {
        $siswaId = auth()->user()->siswa->id;
        $hariIni = Carbon::now('Asia/Jakarta')->locale('id')->isoFormat('dddd');

        // Mengambil semua jadwal yang terkait dengan siswa yang sedang login pada hari ini
        $jadwalHariIni = Jadwal::whereHas('kelas.siswa', function ($query) use ($siswaId) {
            $query->where('siswa.id', $siswaId);
        })->where('hari', $hariIni)->get();

        // Mengambil semua jadwal yang terkait dengan siswa yang sedang login
        // $jadwalSiswa = Jadwal::whereHas('kelas.siswa', function ($query) use ($siswaId) {
        //     $query->where('siswa.id', $siswaId);
        // })->get();
        $jadwalSiswa = Jadwal::whereHas('kelas.siswa', function ($query) use ($siswaId) {
            $query->where('siswa.id', $siswaId);
        })->orderByRaw("CASE
                        WHEN hari = 'Senin' THEN 1
                        WHEN hari = 'Selasa' THEN 2
                        WHEN hari = 'Rabu' THEN 3
                        WHEN hari = 'Kamis' THEN 4
                        WHEN hari = 'Jumat' THEN 5
                        WHEN hari = 'Sabtu' THEN 6
                        WHEN hari = 'Minggu' THEN 7
                        ELSE 8
                    END")
           ->get();

        // Memeriksa status absensi siswa pada jadwal hari ini
        $absensi = collect();
        if ($jadwalHariIni) {
            $jadwalId = $jadwalHariIni->pluck('id');
            $absensi = Absensi::whereIn('jadwal_id', $jadwalId)
                ->where('siswa_id', $siswaId)
                ->where('tanggal', Carbon::today()->toDateString())
                ->get();
        }

        return view('siswa.dashboard', compact('jadwalSiswa', 'jadwalHariIni', 'absensi'));
    }
}
