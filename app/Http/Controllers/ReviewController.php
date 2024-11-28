<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Buku;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create()
    {
        $books = Buku::all(); // Daftar buku
        return view('reviews.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:books,id',
            'review' => 'required|string',
            'tags' => 'required|array',
        ]);

        Review::create([
            'buku_id' => $request->buku_id,
            'user_id' => auth()->id(),
            'review' => $request->review,
            'tags' => json_encode($request->tags),
        ]);

        return redirect()->back()->with('success', 'Review berhasil ditambahkan!');
    }
    public function show($id)
    {
        // Ambil review berdasarkan ID
        $review = Review::with('buku', 'user')->findOrFail($id);

        // Kirim review ke view
        return view('reviews.show', compact('review'));
    }
}
