<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil data artikel dari database
        $articles = Artikel::all();

        return view('admin/dashboard', compact('articles'));
    }
}