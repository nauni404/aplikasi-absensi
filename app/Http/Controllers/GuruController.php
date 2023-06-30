<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Guru::query();

        // Jika ada pencarian NIP / Nama
        if (request('search')) {
            $keyword = '%' . request('search') . '%';
            $query->where(function ($q) use ($keyword) {
                $q->where('nip', 'like', $keyword)
                    ->orWhere('nama', 'like', $keyword);
            });
        }

        $guru = $query->paginate(20);

        return view('admin.guru.index', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nip' => 'required|numeric|unique:guru,nip|digits:18',
            'nama' => 'required|string',
            'jk' => 'required|in:L,P',
        ], [
            'nip.required' => 'NIP harus diisi.',
            'nip.numeric' => 'NIP harus berupa angka.',
            'nip.unique' => 'NIP sudah digunakan.',
            'nip.digits' => 'NIP harus terdiri dari 18 angka.',
            'nama.required' => 'Nama harus diisi.',
            'jk.required' => 'Jenis kelamin harus diisi.',
        ]);

        // Buat guru baru
        $guru = new Guru();
        $guru->nip = $validatedData['nip'];
        $guru->nama = $validatedData['nama'];
        $guru->jk = $validatedData['jk'];
        $guru->save();

        // Berikan respons berhasil
        return redirect()->route('guru.index')->with('success', 'Guru baru telah ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {

        return view('admin.guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
    {
        $validatedData = $request->validate([
            'nip' => 'required|numeric|unique:guru,nip,' . $guru->id . '|digits:18',
            'nama' => 'required|string',
            'jk' => 'required|in:L,P',
        ], [
            'nip.required' => 'NIP harus diisi.',
            'nip.numeric' => 'NIP harus berupa angka.',
            'nip.unique' => 'NIP sudah digunakan.',
            'nip.digits' => 'NIP harus terdiri dari 18 angka.',
            'nama.required' => 'Nama harus diisi.',
            'jk.required' => 'Jenis kelamin harus diisi.',
        ]);

        // Perbarui guru dengan data yang valid
        $guru->update($validatedData);

        // Berikan respons berhasil
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        Guru::destroy($guru->id);

        return redirect()->route('guru.index')->with(['success' => 'Guru Berhasil Dihapus!']);
    }
}
