<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil hari ini dengan format "Y-m-d"
        $today = Carbon::now('Asia/Jakarta')->format('Y-m-d');

        // Mengambil jadwal guru yang sedang mengajar hari ini
        $jadwalHariIni = Jadwal::where('hari', Carbon::now('Asia/Jakarta')->locale('id')->isoFormat('dddd'))
            ->whereDate('jam_mulai', '<=', $today)
            ->whereDate('jam_selesai', '>=', $today)
            ->with(['guru', 'mapel', 'kelas'])
            ->get();

        $totalUsers = User::count();
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalKelas = Kelas::count();
        return view('admin.dashboard', compact('totalUsers', 'totalSiswa', 'totalGuru', 'totalKelas', 'jadwalHariIni'));
    }
}
