<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $title= '';
        if (request('user')) {
            $user = User::firstWhere('username', request('user'));
            $title = $user->username;
        }

        return view('admin.dashboard');
    }
}
