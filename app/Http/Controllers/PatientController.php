<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class PatientController extends Controller
{
    public function index()
    {
        // Mengambil data artikel dari database yang belum dihapus
        $articles = Article::whereNull('deleted_at')->get();
        Log::info('Session Debug', [
            'user_id' => auth()->id(), // Mengambil ID pengguna yang terautentikasi
            'auth_user' => auth()->user() ? auth()->user()->getAuthIdentifier() : null, // Gunakan metode getAuthIdentifier()
            'role' => auth()->user() ? auth()->user()->role : 'Role not available',
            'guard' => Auth::getDefaultDriver(), // Guard yang digunakan
            'session_id' => session()->getId(), // ID sesi
        ]);


        return view('patient.index', compact('articles'));
    }
}
