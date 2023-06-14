<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function guru()
    {
        // Jadwal Guru Hari Ini
        $guruId = auth()->user()->guru->id;
        $hariIni = Carbon::now('Asia/Jakarta')->locale('id')->isoFormat('dddd');

        $jadwalHariIni = Jadwal::where('guru_id', $guruId)
            ->where('hari', $hariIni)
            ->with('kelas')
            ->orderBy('jam_mulai')
            ->get();

        return view('guru.dashboard', compact('jadwalHariIni'));
    }
}
