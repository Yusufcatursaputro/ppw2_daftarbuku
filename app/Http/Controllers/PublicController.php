<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;

class PublicController extends Controller
{
    public function byReviewer(User $user)
{
    $reviews = Review::where('user_id', $user->id)->with('buku')->get();
    return view('public.byReviewer', compact('reviews', 'user'));
}

public function byTag($tag)
{
    $reviews = Review::whereJsonContains('tags', $tag)->with('book')->get();
    return view('public.byTag', compact('reviews', 'tag'));
}

}
