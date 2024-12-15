<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;
class LoginController extends Controller
{
    // public function processLogin(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     // Cek kredensial pengguna
    //     $user = User::where('email', $request->email)->first();

    //     if ($user && Hash::check($request->password, $user->password)) {


    //         // Set user ke sesi
    //         Auth::login($user, $request->has('remember'));

    //         // Log aktivitas
    //         Log::info('User logged in', [
    //             'user_id' => $user->id_users,
    //             'role' => $user->role,
    //             'ip_address' => $request->ip(),
    //             'time' => now(),
    //         ]);

    //         // Validasi role dan redirect
    //         if (in_array($user->role, ['admin', 'doctor', 'patient'])) {
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Login berhasil',
    //                 'redirect_url' => route($user->role . '.dashboard')
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Role tidak valid'
    //             ]);
    //         }
    //     } else {
    //         // Jika kredensial salah
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Email atau password salah'
    //         ]);
    //     }
    // }


    /**
     * Logout pengguna.



     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $guard = Auth::getDefaultDriver(); // Atau bisa menggunakan guard tertentu jika sudah tahu

        Auth::guard($guard)->logout();

        // Menyelesaikan sesi dan mengatur ulang token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function processLogin(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    // Cari user berdasarkan email
    $user = User::where('email', $validatedData['email'])->first();

    // Cek kredensial pengguna
    if ($user && Hash::check($validatedData['password'], $user->password)) {
        // Autentikasi pengguna dengan guard sesuai role
        $guard = $this->getGuardByRole($user->role);

        if ($guard && Auth::guard($guard)->attempt($validatedData, $request->has('remember'))) {
            // Log aktivitas pengguna
            Log::info('User logged in', [
                'user_id' => $user->id_users,
                'role' => $user->role,
                'ip_address' => $request->ip(),
                'time' => now(),
            ]);

            // Redirect berdasarkan role
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'redirect_url' => route($user->role . '.dashboard'),
            ]);
        } else {
            Log::warning('Unauthorized role or guard mismatch', [
                'email' => $validatedData['email'],
                'role' => $user->role,
                'ip_address' => $request->ip(),
                'time' => now(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Role atau guard tidak valid',
            ]);
        }
    } else {
        // Jika kredensial salah
        Log::error('Login failed', [
            'email' => $validatedData['email'],
            'ip_address' => $request->ip(),
            'time' => now(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah',
        ]);
    }
}

/**
 * Mendapatkan guard berdasarkan role pengguna.
 *
 * @param string $role
 * @return string|null
 */
protected function getGuardByRole(string $role): ?string
{
    $guards = [
        'admin' => 'admin',
        'doctor' => 'doctor',
        'patient' => 'patient',
    ];

    return $guards[$role] ?? null;
}


}
