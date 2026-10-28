<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    protected $table = 'portofolio_1172';

    protected $fillable = [
        'judul',
        'deskripsi',
        'teknologi',
        'gambar',
        'tampilkan_gambar',
    ];

    protected $casts = [
        'tampilkan_gambar' => 'boolean',
    ];
}