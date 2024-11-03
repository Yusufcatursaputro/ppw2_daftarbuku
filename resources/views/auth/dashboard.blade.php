

@extends('auth.layouts')

@section('content')

<h1>Daftar Buku</h1>
    @if(Session::has('pesan'))
    <div class="alert alert-success">{{Session::get('pesan')}}</div>
    @endif
    @if(Auth::check() && Auth::user()->role == 'admin')
    <a href="{{ route('create') }}" class="btn btn-primary float-end">Tambah Buku</a>
    @endif
    <form action="{{ route('search') }}" method="get">@csrf
        <input type="text" name="kata" class="form-control" placeholder="Cari ..." style="width: 30%;
        display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">
    </form>
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>id</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                @if(Auth::check() && Auth::user()->role == 'admin')
                <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($data_buku as $buku)
            <tr>
                <td>{{ $buku->id }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ "Rp. ".number_format($buku->harga, 2, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
                <td>
                    @if(Auth::check() && Auth::user()->role == 'admin')
                    <div class="row">
                        <div class="col-md-3">
                            <a class="btn btn-primary" href="{{ route('edit', $buku->id) }}">Edit</a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('destroy', $buku->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin mau dihapus?')" type="submit"
                                    class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>{{ $data_buku->links('pagination::bootstrap-5') }}</div>
    <div><strong>Jumlah Buku: {{ $jumlah_buku }}</strong></div>

    <div>
        <p>Jumlah buku: {{ $totalbuku }}</p>
    </div>

    <div>
        <p>Total harga untuk semua buku: {{ "Rp. ".number_format($totalharga, 2, ',', '.') }}</p>
    </div>
    
@endsection