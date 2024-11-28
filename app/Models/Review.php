<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'user_id', 'review', 'tags'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
