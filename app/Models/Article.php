<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Tentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
        'image',
        'judul',
        'isi',
        'penulis',
    ];

    // Tentukan kolom tanggal jika diperlukan
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
