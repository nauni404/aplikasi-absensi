<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        return view('admin.absensi.index', [
            'kelas' => Kelas::paginate(10)
        ]);
    }

    public function show($kelasId)
    {
        $kelas = Kelas::firstWhere('id', $kelasId);

        $count = Siswa::where('kelas_id', $kelasId)->whereHas('absensi')->count();

        return view('admin.absensi.show', compact('kelas', 'count'));
    }

    public function store(Request $request)
    {
        // dd(auth()->user()->guru->id);
        $absensiData = $request->input('siswa');
        $tanggal = now('Asia/Jakarta')->format('Y-m-d');
        // $guruId = auth()->user()->guru->id;
        $guruId = auth()->user()->id;
        $kelasId = $request->kelas;

        foreach ($absensiData as $index => $siswaId) {
            $status = $request->input('status.' . ($index + 1));

            $existingAbsensi = Absensi::where('siswa_id', $siswaId)
                ->where('tanggal', $tanggal)->first();

            if ($existingAbsensi) {
                // Update absensi jika sudah ada
                $existingAbsensi->update([
                    'status' => $status,
                ]);
                $pesan = 'diupdate';
            } else {
                // Buat absensi baru jika belum ada
                Absensi::create([
                    'siswa_id' => $siswaId,
                    'guru_id' => $guruId,
                    'kelas_id' => $kelasId,
                    'tanggal' => $tanggal,
                    'status' => $status
                ]);
                $pesan = 'disimpan';
            }
        }

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil ' .$pesan);
    }
}
