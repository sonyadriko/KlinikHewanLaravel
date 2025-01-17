<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussions extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'discussions';

    // Kolom yang bisa diisi
    protected $fillable = [
        'discussion_content',
        'user_id',
    ];

    // Relasi dengan model User (penulis diskusi)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_users');
    }

    // Relasi dengan model DiscussionAnswer (jawaban dari diskusi)
    public function answers()
    {
        return $this->hasMany(DiscussionAnswers::class);
    }
}
