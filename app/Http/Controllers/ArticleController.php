<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Article;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreArtikelRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    //
    public function index(){
        $articles = Article::paginate(10); // Paginate 10 items per page
        Log::info('Session Debug', [
            'user_id' => session()->get('user_id'), // Cek jika id ada di dalam sesi
            'auth_user' => Auth()->user() ? Auth()->user()->id_users : null, // Pastikan pengguna terautentikasi dan ambil ID jika ada
            'session_id' => session()->getId(), // ID sesi
        ]);

        return view('admin.article.index', compact('articles'));
    }

    public function create(){
        return view('admin.article.create');
    }

    public function store(StoreArtikelRequest $request)
    {
        $imagePath = $request->file('gambar')->store('uploads', 'public');
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus masuk untuk menambahkan artikel.');
        }

        Article::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'image' => $imagePath,
            'penulis' => Auth::user()->name,
        ]);

        return redirect()->route('article.index')->with('success', 'Artikel berhasil ditambahkan!');
    }
    public function edit($id)
    {
        // Mengambil data artikel berdasarkan ID
        $article = Article::findOrFail($id);

        // Menampilkan halaman edit dengan data artikel
        return view('admin.article.edit', compact('article'));
    }
    public function update(Request $request, Article $artikel)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Update fields
        $artikel->judul = $request->judul;
        $artikel->isi = $request->isi;

        // Handle file upload if exists
        if ($request->hasFile('gambar')) {
            // Optional: delete the old file
            if ($artikel->image && Storage::disk('public')->exists($artikel->image)) {
                Storage::disk('public')->delete($artikel->image);
            }

            // Store new file
            $imagePath = $request->file('gambar')->store('uploads', 'public');
            $artikel->image = $imagePath;
        }

        $artikel->save();

        return redirect()->route('article.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    // public function destroy($id)
    // {
    //     $article = Article::find($id);

    //     if (!$article) {
    //         return response()->json(['success' => false, 'message' => 'Artikel tidak ditemukan.']);
    //     }

    //     // Hapus gambar dari storage jika ada
    //     if ($article->image && Storage::disk('public')->exists($article->image)) {
    //         Storage::disk('public')->delete($article->image);
    //     }

    //     // Hapus artikel dari database
    //     $article->delete();

    //     return response()->json(['success' => true, 'message' => 'Artikel berhasil dihapus.']);
    // }

    public function destroy($id)
{
    // Cari artikel berdasarkan ID
    $article = Article::find($id);

    // Cek apakah artikel ditemukan
    if (!$article) {
        return redirect()->route('article.index')->with('error', 'Artikel tidak ditemukan.');
    }

    // Hapus artikel
    $article->delete();

    // Redirect kembali ke halaman artikel dengan pesan sukses
    return redirect()->route('article.index')->with('success', 'Artikel berhasil dihapus!');
}

public function show($id)
{
    // Ambil artikel berdasarkan ID
    $article = DB::table('artikel')->where('id_artikel', $id)->first();

    // Jika artikel tidak ditemukan, tampilkan pesan error
    if (!$article) {
        return redirect()->back()->with('error', 'Artikel tidak ditemukan.');
    }

    return view('detail', compact('article'));
}


}
