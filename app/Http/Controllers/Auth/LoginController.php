<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;
class LoginController extends Controller
{public function processLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Cek kredensial pengguna
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // if (!$user->is_active) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Akun Anda tidak aktif. Hubungi administrator.'
            //     ]);
            // }

            // Set user ke sesi
            Auth::login($user, $request->has('remember'));

            // Log aktivitas
            Log::info('User logged in', [
                'user_id' => $user->id_users,
                'role' => $user->role,
                'ip_address' => $request->ip(),
                'time' => now(),
            ]);

            // Validasi role dan redirect
            if (in_array($user->role, ['admin', 'dokter', 'pasien'])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil',
                    'redirect_url' => route($user->role . '.dashboard')
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Role tidak valid'
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
