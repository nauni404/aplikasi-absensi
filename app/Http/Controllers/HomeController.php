<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role=='admin') {
                return redirect('admin/dashboard');
            } elseif (Auth::user()->role === 'guru') {
                return redirect('guru/dashboard');
            } elseif (Auth::user()->role === 'siswa') {
                return redirect('siswa/dashboard');
            }
        }
        return view('auth.login');
    }
}
