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
        $query = User::query();

        // Jika ada pencarian NIP / Nama
        if (request('search')) {
            $keyword = '%' . request('search') . '%';
            $query->where(function ($q) use ($keyword) {
                $q->where('username', 'like', $keyword);
            });
        }

        $user = $query->paginate(20);

        return view('admin.user.index', [
            'users' => $user
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
            'username' => 'required|string|min:5|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:Admin,Guru,Siswa',
            'guru_id' => 'required_if:role,Guru|nullable|exists:guru,id',
            'siswa_id' => 'required_if:role,Siswa|nullable|exists:siswa,id',
        ], [
            'username.required' => 'Username harus diisi.',
            'username.min' => 'Username minimal terdiri dari 5 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Role harus diisi.',
            'role.in' => 'Role harus Admin, Guru, atau Siswa.',
            'guru_id.required_if' => 'Guru ID harus diisi jika role adalah Guru.',
            'guru_id.exists' => 'Guru ID tidak valid.',
            'siswa_id.required_if' => 'Siswa ID harus diisi jika role adalah Siswa.',
            'siswa_id.exists' => 'Siswa ID tidak valid.',
        ]);

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
        return redirect()->route('user.index')->with('success', 'User baru telah ditambahkan!');
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
        $validatedData = $request->validate([
            'username' => 'required|string|min:5|unique:users,username,' . $user->id,
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,guru,siswa',
            'guru_id' => 'nullable|required_if:role,guru|exists:guru,id',
            'siswa_id' => 'nullable|required_if:role,siswa|exists:siswa,id',
        ], [
            'username.required' => 'Username harus diisi.',
            'username.min' => 'Username minimal 5 karakter.',
            'username.unique' => 'Username sudah digunakan',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal harus memiliki :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Peran harus dipilih.',
            'role.in' => 'Peran yang dipilih tidak valid.',
            'guru_id.required_if' => 'ID guru harus diisi jika peran adalah "guru".',
            'guru_id.exists' => 'ID guru yang dipilih tidak valid.',
            'siswa_id.required_if' => 'ID siswa harus diisi jika peran adalah "siswa".',
            'siswa_id.exists' => 'ID siswa yang dipilih tidak valid.',
        ]);

        // Perbarui data pengguna yang ada
        $user->username = $validatedData['username'];
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
