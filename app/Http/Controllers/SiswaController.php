<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Siswa::query();

        // Jika ada pencarian NIP / Nama
        if (request('search')) {
            $keyword = '%' . request('search') . '%';
            $query->where(function ($q) use ($keyword) {
                $q->where('nis', 'like', $keyword)
                    ->orWhere('nama', 'like', $keyword);
            });
        }

        $siswa = $query->paginate(20);

        return view('admin.siswa.index', [
            'siswa' => $siswa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'nis' => 'required|numeric|unique:siswa|digits:10',
            'nama' => 'required|string',
            'jk' => 'required|in:L,P',
        ], [
            'nis.required' => 'NIS harus diisi.',
            'nis.numeric' => 'NIS harus berupa angka.',
            'nis.unique' => 'NIS sudah digunakan.',
            'nis.digits' => 'NIS harus terdiri dari 10 angka.',
            'nama.required' => 'Nama harus diisi.',
            'jk.required' => 'Jenis kelamin harus diisi.',
        ]);

        // Buat pengguna baru
        $validatedData = $validator->validated();
        $user = new Siswa($validatedData);
        $user->save();

        // Berikan respons berhasil
        return redirect()->route('siswa.index')->with('success', 'Siswa baru telah ditambahkan!');
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
    public function edit(Siswa $siswa)
    {
        return view('admin.siswa.edit', [
            'siswa' => $siswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validatedData = $request->validate([
            'nis' => 'required|numeric|unique:siswa,nis,' . $siswa->id . '|digits:10',
            'nama' => 'required|string',
            'jk' => 'required|in:L,P',
        ], [
            'nis.required' => 'NIS harus diisi.',
            'nis.numeric' => 'NIS harus berupa angka.',
            'nis.unique' => 'NIS sudah digunakan.',
            'nis.digits' => 'NIS harus terdiri dari 10 angka.',
            'nama.required' => 'Nama harus diisi.',
            'jk.required' => 'Jenis kelamin harus diisi.',
            'jk.in' => 'Jenis kelamin harus L atau P.',
        ]);

        // Update siswa
        $siswa->update($validatedData);

        // Berikan respons berhasil
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }


    /**
     *  the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        Siswa::destroy($siswa->id);

        return redirect()->route('siswa.index')->with(['success' => 'Siswa Berhasil Dihapus!']);
    }

    public function importExcel()
    {
        Excel::import(new SiswaImport, request()->file('file'));

        return redirect()->back()->with('success', 'Data siswa berhasil diimpor.');
    }
}
