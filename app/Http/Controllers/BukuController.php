<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Gallery;
use App\Models\Review;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $batas = 5;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'asc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);


        $totalbuku = Buku::all()->count();

        $totalharga = Buku::all()->sum('harga');

        $editorialPicks = Buku::where('is_editorial_pick', true)->take(5)->get();

        return view('auth.dashboard', compact('data_buku', 'totalharga', 'totalbuku', 'jumlah_buku', 'no', 'editorialPicks'));
    }


    public function search(Request $request)
    {
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%" . $cari . "%")->orwhere('penulis', 'like', "%" . $cari . "%")
            ->paginate($batas);
        $jumlah_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);

        return view('search', compact('data_buku', 'cari', 'jumlah_buku', 'no'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul'         => 'required|string',
            'penulis'       => 'required|string|max:30',
            'harga'         => 'required|numeric',
            'tgl_terbit'    => 'required|date',
            'diskon'        => 'nullable|numeric|min:0|max:100',
        ]);
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->diskon = $request->diskon;
        $buku->save();


        return redirect('/buku')->with('pesan', 'Data buku berhasil ditambah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku')->with('pesan', 'Data buku berhasil dihapus');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $buku = Buku::findOrFail($id);

        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048',
            'gallery.*' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'diskon'    => 'nullable|numeric|min:0|max:100',
        ]);

        $filename = time() . '_' . $request->thumbnail->getClientOriginalName();
        $filepath = $request->file('thumbnail')->storeAs('uploads', $filename, 'public');

        Image::make(storage_path() . '/app/public/uploads/' . $filename)
            ->fit(240, 320)
            ->save();

        $buku->update([
            'judul'     => $request->judul,
            'penulis'   => $request->penulis,
            'harga'     => $request->harga,
            'diskon'    => $request->diskon,
            'tgl_terbit' => $request->tgl_terbit,
            'filename'  => $filename,
            'filepath'  => '/storage/' . $filepath,
            'is_editorial_pick' => $request->has('is_editorial_pick')
        ]);


        if ($request->file('gallery')) {
            foreach ($request->file('gallery') as $key => $file) {
                if ($file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('uploads', $fileName, 'public');
                    $keterangan = $request->input('keterangan')[$key] ?? null;

                    $gallery = Gallery::create([
                        'nama_galeri'   => $fileName,
                        'path'          => '/storage/' . $filePath,
                        'foto'          => $fileName,
                        'buku_id'       => $id,
                        'keterangan'    => $keterangan
                    ]);
                }
            }
        }

        return redirect('/buku')->with('pesan', 'Perubahan Data Buku Berhasil di Simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil review berdasarkan ID
        $review = Review::with('buku', 'user')->findOrFail($id);

        // Kirim review ke view
        return view('reviews.show', compact('review'));
    }


    public function deleteGalleryImage(string $bukuId, string $galleryId)
    {
        // Temukan data gambar galeri yang sesuai dengan buku
        $gallery = Gallery::where('buku_id', $bukuId)->findOrFail($galleryId);

        // Hapus gambar dari penyimpanan
        if ($gallery->path && Storage::exists('public/' . $gallery->path)) {
            Storage::delete('public/' . $gallery->path);
        }

        // Hapus data galeri dari database
        $gallery->delete();

        return redirect('/buku')->with('pesan', 'Gambar galeri berhasil dihapus');
    }
}
