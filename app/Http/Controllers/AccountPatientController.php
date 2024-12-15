<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountPatientController extends Controller
{
    public function index()
    {
        // Mendapatkan data pengguna dengan peran 'pasien'
        $users = User::where('role', 'patient')->get();

        return view('admin.account.index', compact('users'));
    }

    public function create()
    {
        return view('admin.account.create');
    }
    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
        'phone' => 'required|string|max:15',
    ]);

    User::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => bcrypt($request->password), // Use bcrypt for secure password hashing
        'notelp' => $request->phone,
        'role' => 'patient',
    ]);

    return redirect()->route('account-patient.index')->with('success', 'Pemilik Hewan berhasil ditambahkan!');
}

}
