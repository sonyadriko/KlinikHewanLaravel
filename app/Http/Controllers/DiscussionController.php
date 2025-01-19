<?php

namespace App\Http\Controllers;

use App\Models\Discussions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function index()
    {
        // $user = Auth::user()->role;
        // dd($user); // Debug: Periksa apakah user terdeteksi
        $discussions = Discussions::join('users', 'discussions.user_id', 'users.id')
            ->select('discussions.*', 'users.nama')
            ->orderBy('discussions.created_at', 'desc')
            ->get();

        return view('discussion.index', compact('discussions'));
    }

    // Menyimpan pertanyaan baru
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Discussions::create([
            'discussion_content' => $request->content,
            'user_id' => Auth::user()->id,
            'created_at' => now(),
        ]);

        return redirect()->route('discussion.index')->with('success', 'Pertanyaan berhasil ditambahkan!');
    }
}
