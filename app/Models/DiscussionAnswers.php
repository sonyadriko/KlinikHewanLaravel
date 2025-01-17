<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscussionAnswers extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'discussion_answers';

    // Kolom yang bisa diisi
    protected $fillable = [
        'discussion_id',
        'answer_content',
        'user_id',
    ];

    // Relasi dengan model Discussion (diskusi yang dijawab)
    public function discussion()
    {
        return $this->belongsTo(Discussions::class);
    }

    // Relasi dengan model User (penulis jawaban)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
