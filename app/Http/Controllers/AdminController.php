<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        return view('admin.dashboard', compact('totalUsers', 'totalSiswa', 'totalGuru'));
    }
}
