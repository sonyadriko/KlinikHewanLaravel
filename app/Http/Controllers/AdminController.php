<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class AdminController extends Controller
{
    public function index()
    {
        // Mengambil data artikel dari database yang belum dihapus
        $articles = Article::whereNull('deleted_at')->get();
        Log::info('Session Debug', [
            'user_id' => auth()->check() ? auth()->id() : null,
            'auth_user' => auth()->check() ? auth()->user()->id : null,
            'role' => auth()->check() ? auth()->user()->role : 'Role not available',
            'guard' => Auth::getDefaultDriver(),
            'session_id' => session()->getId(),
        ]);
        return view('admin/dashboard', compact('articles'));
    }
}
