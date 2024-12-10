<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi
    protected $table = 'artikel';

    // Tentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
        'image',
        'judul',
        'isi',
        'penulis',
    ];

    // Tentukan kolom yang tidak boleh diubah (guarded)
    // protected $guarded = ['id_artikel'];

    // Tentukan kolom tanggal jika diperlukan
    protected $dates = ['created_at', 'updated_at'];
}