<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $dates = ['tgl_terbit'];
    protected $fillable = [
        'id',
        'judul',
        'penulis',
        'harga',
        'tgl_terbit',
        'filename',
        'filepath'
    ];

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class, 'buku_id');
    }
}
