<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h4>Edit Buku</h4>
        <form method="post" action="{{ route('update', $buku->id) }}" enctype="multipart/form-data">
            @csrf
            <div>Judul <input type="text" name="judul" class="form-control" value="{{ $buku->judul }}"></div>
            <div>Penulis <input type="text" name="penulis" class="form-control" value="{{ $buku->penulis }}"></div>
            <div>Harga <input type="text" name="harga" class="form-control" value="{{ $buku->harga }}"></div>
            <div class="form-group">
                <label for="diskon">Diskon (%)</label>
                <input type="text" name="diskon" class="form-control" step="0.01" min="0" max="100" placeholder="Masukkan diskon dalam persen">
            </div>
            <div>Tanggal Terbit <input type="date" id="tgl_terbit" name="tgl_terbit"
                    class="date form-control" placeholder="yyyy/mm/dd" value="{{ $buku->tgl_terbit }}"></div>
            <!-- thumbnail -->
            <div>
                <label class="form-label">Gambar</label>
                <input type="file" name="thumbnail"
                    class="form-control" value="{{ $buku->filename }}">
            </div>

            <!-- Checkbox untuk Editorial Pick -->
            <div class="form-check">
                <input type="checkbox" name="is_editorial_pick" class="form-check-input" id="is_editorial_pick" {{ $buku->is_editorial_pick ? 'checked' : '' }}>
                <label class="form-check-label" for="is_editorial_pick">Editorial Pick</label>
            </div>

            <!-- Tambahkan Galeri -->
            <label for="gallery" class="block text-sm font-medium leading-6 text-gray-900">Gallery</label>
            <div class="mt-2" id="fileinput_wrapper">
                <!-- Area untuk input file galeri tambahan -->
            </div>
            <button type="button" class="btn btn-primary mt-2" onclick="addFileInput()">Tambah Input Data</button>


            <br><br>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ url('/buku') }}" class="btn btn-secondary">Kembali</a>
        </form>

        <!-- Daftar Gambar Galeri yang Sudah Ada -->
        <div class="gallery_items mt-4">
            <h5>Galeri Gambar</h5>
            @foreach($buku->galleries as $gallery)
            <div class="galery_item mb-3">
                <img class="rounded object-cover object-center" src="{{ asset($gallery->path) }}" alt=""  height="200" width="200">
                <p class="text-break">{{ $gallery->keterangan }}</p>
                <!-- Form Hapus Gambar Galeri -->
                <form action="{{ route('deleteGalleryImage', [$buku->id, $gallery->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Gambar</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>


    <script type="text/datepicker">
        $('.date').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: 'true'
        })
    </script>
    <script type="text/javascript"
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function addFileInput() {
            const wrapper = document.getElementById('fileinput_wrapper');
            const newInput = document.createElement('div');
            newInput.classList.add('gallery-item');
            newInput.innerHTML = `
        <input type="file" name="gallery[]" class="form-control" required>
        <input type="text" name="keterangan[]" placeholder="Keterangan gambar" class="form-control mt-1">
    `;
            wrapper.appendChild(newInput);
        }
    </script>


</body>

</html>