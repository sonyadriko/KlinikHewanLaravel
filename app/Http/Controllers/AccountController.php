<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AccountController extends Controller
{
    public function index()
    {
        // Mendapatkan data pengguna dengan peran 'pasien'
        $users = User::where('role', 'pasien')->get();

        return view('admin.account.index', compact('users'));
    }
}
