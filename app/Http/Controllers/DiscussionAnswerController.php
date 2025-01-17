<?php

namespace App\Http\Controllers;

use App\Models\DiscussionAnswers;
use App\Models\Discussions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionAnswerController extends Controller
{
    public function show($id)
    {
        $question = Discussions::with('user')->findOrFail($id);
        $answers = DiscussionAnswers::where('discussion_id', $id)->with('user')->orderBy('created_at', 'asc')->get();

        return view('discussion.reply', compact('question', 'answers'));
    }

    // Menyimpan balasan
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $discussion = Discussions::findOrFail($id);

        DiscussionAnswers::create([
            'discussion_id' => $id,
            'answer_content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('discussion_answer.show', $id)->with('success', 'Balasan berhasil ditambahkan!');
    }
}
