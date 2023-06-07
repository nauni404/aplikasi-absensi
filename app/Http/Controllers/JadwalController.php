<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwals = Jadwal::with(['guru', 'mapel', 'kelas'])->get();

        return view('admin.jadwal.index', compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gurus = Guru::all();
        $mapels = Mapel::all();
        $kelas = Kelas::all();

        return view('admin.jadwal.create', compact('gurus', 'mapels', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $validator = Validator::make($request->all(), [
            'guru_id' => 'required',
            'mapel_id' => 'required',
            'kelas_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ], [
            'guru_id.required' => 'Guru harus dipilih.',
            'mapel_id.required' => 'Mata Pelajaran harus dipilih.',
            'kelas_id.required' => 'Kelas harus dipilih.',
            'hari.required' => 'Hari harus diisi.',
            'jam_mulai.required' => 'Jam Mulai harus diisi.',
            'jam_selesai.required' => 'Jam Selesai harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('jadwal.create')
                ->withErrors($validator)
                ->withInput();
        }

        // Buat jadwal baru dengan data yang valid
        $validatedData = $validator->validated();
        $user = new Jadwal($validatedData);
        $user->save();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        $gurus = Guru::all();
        $mapels = Mapel::all();
        $kelas = Kelas::all();

        return view('admin.jadwal.edit', compact('jadwal', 'gurus', 'mapels', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'guru_id' => 'required',
            'mapel_id' => 'required',
            'kelas_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ], [
            'guru_id.required' => 'Guru harus dipilih.',
            'mapel_id.required' => 'Mata Pelajaran harus dipilih.',
            'kelas_id.required' => 'Kelas harus dipilih.',
            'hari.required' => 'Hari harus diisi.',
            'jam_mulai.required' => 'Jam Mulai harus diisi.',
            'jam_selesai.required' => 'Jam Selesai harus diisi.',
        ]);

        // Perbarui jadwal dengan data yang valid
        $jadwal->update($validatedData);

        return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        Jadwal::destroy($jadwal->id);

        return redirect()->route('jadwal.index')->with(['success' => 'Jadwal Berhasil Dihapus!']);
    }
}
