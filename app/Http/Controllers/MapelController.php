<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Mapel::query();

        // Jika ada pencarian nama mapel
        if (request('search')) {
            $keyword = '%' . request('search') . '%';
            $query->where('nama', 'like', $keyword);
        }

        $mapels = $query->paginate(20);

        return view('admin.mapel.index', compact('mapels'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mapel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
        ], [
            'nama.required' => 'Nama harus diisi.',
        ]);

        // Buat pengguna baru
        $validatedData = $validator->validated();
        $user = new Mapel($validatedData);
        $user->save();

        // Berikan respons berhasil
        return redirect()->route('mapel.index')->with('success', 'Mapel baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mapel $mapel)
    {
        return view('admin.mapel.edit', compact('mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mapel $mapel)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'nama' => 'required|string',
        ], [
            'nama.required' => 'Nama harus diisi.',
        ]);

        // Update siswa
        $mapel->update($validatedData);

        // Berikan respons berhasil
        return redirect()->route('mapel.index')->with('success', 'Data mapel berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapel $mapel)
    {
        Mapel::destroy($mapel->id);

        return redirect()->route('mapel.index')->with(['success' => 'Mapel Berhasil Dihapus!']);
    }
}
