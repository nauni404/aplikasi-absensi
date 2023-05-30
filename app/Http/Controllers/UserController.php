<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user.index', [
            'users' => User::paginate(10)
        ]);
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);

        return redirect()->route('user.index')->with(['success' => 'User Berhasil Dihapus!']);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create',[
            'siswa' => Siswa::all(),
            'guru' => Guru::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:5|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:Admin,Guru,Siswa',
            'guru_id' => 'required_if:role,Guru|nullable|exists:guru,id',
            'siswa_id' => 'required_if:role,Siswa|nullable|exists:siswa,id',
        ]);

        // Jika validasi gagal, kirimkan pesan error
        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => $validator->errors()->first(),
        //     ], 400);
        // }

        // Periksa apakah nama pengguna sudah terdaftar
        $usernameExists = User::where('username', $request->username)->exists();
        if ($usernameExists) {
            return back()->with([
                'status' => 'error',
                'message' => 'Username sudah digunakan.',
            ]);

        }

        // Buat pengguna baru
        $validatedData = $validator->validated();
        $validatedData['password'] = Hash::make($request->password);
        $user = new User($validatedData);
        $user->save();

        // Atur peran dan ID terkait berdasarkan input pengguna
        if ($request->role === 'Admin') {
            // Jika perlu, tambahkan logika khusus untuk peran admin di sini
        } elseif ($request->role === 'Guru') {
            $guru = Guru::findOrFail($request->guru_id);
            $user->guru_id = $guru->id;
            $user->save();
        } elseif ($request->role === 'Siswa') {
            $siswa = Siswa::findOrFail($request->siswa_id);
            $user->siswa_id = $siswa->id;
            $user->save();
        }

        // Berikan respons berhasil
        return redirect()->route('user.index')->with('success', 'New user has been added!');
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
    public function edit(User $user)
    {
        return view('admin.user.edit', [
            'user' => $user,
            'siswa' => Siswa::all(),
            'guru' => Guru::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, User $user)
    {
        $rules = [
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,guru,siswa',
            'guru_id' => 'nullable|required_if:role,guru|exists:guru,id',
            'siswa_id' => 'nullable|required_if:role,siswa|exists:siswa,id',
            'username' => 'required|string|min:5|unique:users|max:255',
        ];

        // Kondisi jika username diganti / tidak diganti
        if (isset($request->username) && $request->username == $user->username) {
            unset($rules['username']);
        }

        $validatedData = $request->validate($rules);

        // Perbarui data pengguna yang ada
        if (isset($validatedData['username'])) {
            $user->username = $validatedData['username'];
        } else {
            $user->username = $user->username;
        }
        $user->password = Hash::make($validatedData['password']);

        // Atur peran dan ID terkait berdasarkan input pengguna
        if ($request->role === 'admin') {
            $user->role = 'admin';
            $user->guru_id = null;
            $user->siswa_id = null;
        } elseif ($request->role === 'guru') {
            $user->role = 'guru';
            $user->guru_id = $request->guru_id;
            $user->siswa_id = null;
        } elseif ($request->role === 'siswa') {
            $user->role = 'siswa';
            $user->siswa_id = $request->siswa_id;
            $user->guru_id = null;
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui!');
    }


}
