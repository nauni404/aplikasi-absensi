<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        return view('admin.absensi.index', [
            'kelas' => Kelas::paginate(10)
        ]);
    }
}
