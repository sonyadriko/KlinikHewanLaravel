<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class LoginController extends Controller
{
    public function processLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Cek kredensial pengguna
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Set user ke sesi
            // dd($user, Auth::user());
            Auth::login($user);

            // Memeriksa peran pengguna dan mengarahkan ke dashboard yang sesuai
            if ($user->role === 'admin') {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil',
                    'redirect_url' => route('admin.dashboard') // Arahkan ke dashboard admin
                ]);
            } elseif ($user->role === 'dokter') {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil',
                    'redirect_url' => route('dokter.dashboard') // Arahkan ke dashboard dokter
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil',
                    'redirect_url' => route('pasien.dashboard') // Arahkan ke dashboard pasien
                ]);
            }
        } else {
            // Jika kredensial salah
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah'
            ]);
        }
    }

    /**
     * Logout pengguna.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}