<?php

namespace App\Http\Controllers\Auth;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }

        return back()
            ->withInput($request->only('username'))
            ->withErrors([
                'loginError' => 'Username atau Password salah.',
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function pengaturanAdmin()
    {
        $user = Auth::user();
        return view('admin.pengaturan', compact('user'));;
    }

    public function pengaturanGuru()
    {
        $user = Auth::user();
        return view('guru.pengaturan', compact('user'));;
    }

    public function pengaturanSiswa()
    {
        $user = Auth::user();
        return view('siswa.pengaturan', compact('user'));;
    }

    public function changeUsername(Request $request)
    {
        $user = $request->user(); // Mendapatkan user yang sedang login

        // Validasi data yang dikirimkan oleh pengguna
        $this->validate($request, [
            'new_username' => 'required|string|unique:users,username',
        ]);

        // Mengubah username sesuai dengan peran (role) yang sedang login
        if ($user->role === 'admin') {
            $user->username = $request->new_username;
            $user->save();
        } elseif ($user->role === 'guru') {
            $user->username = $request->new_username;
            $user->save();
        } elseif ($user->role === 'siswa') {
            $user->username = $request->new_username;
            $user->save();
        }

        return back()->with('success', 'Username telah berhasil diubah!');
    }


    public function changePassword(Request $request)
    {
        $user = $request->user(); // Mendapatkan user yang sedang login

        // Validasi data yang dikirimkan oleh pengguna
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'new_password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
        ]);

        // Memeriksa apakah password saat ini sesuai dengan yang ada di database
        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Password Salah.'],
            ]);
        }

        // Mengganti password sesuai dengan peran (role) yang sedang login
        if ($user->role === 'admin') {
            $user->password = Hash::make($request->new_password);
            $user->save();
        } elseif ($user->role === 'guru') {
            $user->password = Hash::make($request->new_password);
            $user->save();
        } elseif ($user->role === 'siswa') {
            $user->password = Hash::make($request->new_password);
            $user->save();
        }

        return back()->with('success', 'Password telah berhasil diubah!');
    }
}
