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
        <form method="post" action="{{ route('update', $buku->id) }}">
            @csrf
            <div>Judul <input type="text" name="judul" class="form-control" value="{{ $buku->judul }}"></div>
            <div>Penulis <input type="text" name="penulis" class="form-control" value="{{ $buku->penulis }}"></div>
            <div>Harga <input type="text" name="harga" class="form-control" value="{{ $buku->harga }}"></div>
            <div>Tanggal Terbit <input type="date" id="tgl_terbit" name="tgl_terbit"
                    class="date form-control" placeholder="yyyy/mm/dd" value="{{ $buku->tgl_terbit }}"></div>
            <br>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ url('/buku') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script type="text/datepicker">
        $('.date').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: 'true'
        })
    </script>
    <script type="text/javascript"
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

