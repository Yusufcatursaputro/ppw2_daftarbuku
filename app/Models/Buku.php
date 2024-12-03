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
    protected $casts = [
        'tgl_terbit' => 'date:Y-m-d',
    ];
    protected $fillable = [
        'id',
        'judul',
        'penulis',
        'harga',
        'created_at',
        'updated_at',
        'tgl_terbit',
        'filename',
        'filepath',
        'is_editorial_pick',
        'diskon',
    ];

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class, 'buku_id');
    }

    public function hargaSetelahDiskon()
    {
        if ($this->diskon) {
            return $this->harga - ($this->harga * ($this->diskon / 100));
        }
        return $this->harga;
    }
}
