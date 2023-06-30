<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.kelas.index', [
            'kelas' => Kelas::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'tingkat_kelas' => 'required|in:X,XI,XII',
            'jurusan' => 'required|in:IPA,IPS,AGAMA',
            'nama' => 'required|string',
            'tahun_masuk' => 'required|date_format:Y',
            'tahun_keluar' => 'required|date_format:Y',
        ], [
            'tingkat_kelas.required' => 'Tingkat kelas harus diisi.',
            'tingkat_kelas.in' => 'Tingkat kelas harus salah satu dari: X, XI, XII.',
            'jurusan.required' => 'Jurusan harus diisi.',
            'jurusan.in' => 'Jurusan harus salah satu dari: IPA, IPS, AGAMA.',
            'nama.required' => 'Nama harus diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'tahun_masuk.required' => 'Tahun masuk harus diisi.',
            'tahun_masuk.date_format' => 'Tahun masuk harus dalam format tahun (YYYY).',
            'tahun_keluar.required' => 'Tahun keluar harus diisi.',
            'tahun_keluar.date_format' => 'Tahun keluar harus dalam format tahun (YYYY).',
        ]);

        // Buat kelas baru
        $validatedData = $validator->validated();
        $user = new Kelas($validatedData);
        $user->save();

        // Berikan respons berhasil
        return redirect()->route('kelas.index')->with('success', 'Kelas baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($kelasId)
    {
        $kelas = Kelas::firstWhere('id', $kelasId);

        return view('admin.kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kela)
    {
        return view('admin.kelas.edit', [
            'kelas' => $kela
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Kelas $kela)
    {
        $validatedData = $request->validate([
            'tingkat_kelas' => 'required|in:X,XI,XII',
            'jurusan' => 'required|in:IPA,IPS,AGAMA',
            'nama' => 'required|string',
            'tahun_masuk' => 'required|date_format:Y',
            'tahun_keluar' => 'required|date_format:Y',
        ], [
            'tingkat_kelas.required' => 'Tingkat kelas harus diisi.',
            'tingkat_kelas.in' => 'Tingkat kelas harus salah satu dari: X, XI, XII.',
            'jurusan.required' => 'Jurusan harus diisi.',
            'jurusan.in' => 'Jurusan harus salah satu dari: IPA, IPS, AGAMA.',
            'nama.required' => 'Nama harus diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'tahun_masuk.required' => 'Tahun masuk harus diisi.',
            'tahun_masuk.date_format' => 'Tahun masuk harus dalam format tahun (YYYY).',
            'tahun_keluar.required' => 'Tahun keluar harus diisi.',
            'tahun_keluar.date_format' => 'Tahun keluar harus dalam format tahun (YYYY).',
        ]);

        // Update kelas
        $kela->update($validatedData);

        // Berikan respons berhasil
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kela)
    {
        Kelas::destroy($kela->id);

        return redirect()->route('kelas.index')->with(['success' => 'Kelas Berhasil Dihapus!']);
    }

    public function hapusKelasId($id)
    {
        // Menghapus nilai kelas_id dari tabel siswa
        Siswa::where('id', $id)->update(['kelas_id' => null]);

        // Tambahkan kode lain yang ingin Anda jalankan setelah menghapus siswa

        return redirect()->back()->with(['success' => 'Siswa Berhasil Dihapus Dari Kelas!']);
    }

    public function tambah($id)
    {
        $kelas = Kelas::find($id);
        $kelas_id = $id;
        $siswa = Siswa::query();

        // Jika ada pencarian NIS / Nama
        if (request('search')) {
            $keyword = '%' . request('search') . '%';
            $siswa->where(function ($q) use ($keyword) {
                $q->where('nis', 'like', $keyword)
                    ->orWhere('nama', 'like', $keyword);
            });
        }

        $siswa = $siswa->get();

        return view('admin.kelas.tambah', [
            'siswa' => $siswa,
            'kelas_id' => $kelas_id,
            'kelas' => $kelas
        ]);
    }

    public function tambahSiswa($siswaId, $kelasId)
    {
        // Menambahkan nilai kelas_id dari tabel siswa
        Siswa::where('id', $siswaId)->update(['kelas_id' => $kelasId]);
        return redirect()->back()->with(['success' => 'Siswa Berhasil Ditambahkan Kedalam Kelas!']);

    }
}
