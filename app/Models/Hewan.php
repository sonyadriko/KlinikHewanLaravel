<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nama_hewan', 'jenis_hewan', 'jenis_kelamin', 'ras_hewan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
