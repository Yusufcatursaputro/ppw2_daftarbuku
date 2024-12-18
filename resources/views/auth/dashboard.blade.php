@extends('auth.layouts')

@section('content')

<h1>Daftar Buku</h1>
@if(Session::has('pesan'))
<div class="alert alert-success">{{Session::get('pesan')}}</div>
@endif
@if(Auth::check() && Auth::user()->role == 'admin')
<div href="{{ route('create') }}" class="btn btn-primary float-end ms-3">Tambah Buku</div>
@endif
<form action="{{ route('search') }}" method="get">@csrf
    <input type="text" name="kata" class="form-control" placeholder="Cari ..." style="width: 30%; display: inline; float: right;">
</form>
<table class="table mt-5">
    <thead>
        <tr class="table-secondary">
            <th>Thumbnail</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Harga</th>
            <th>Diskon</th>
            <th>Harga Baru</th>
            <th>Tanggal Terbit</th>
            @if(Auth::check() && Auth::user()->role == 'admin')
            <th>Aksi</th>
            @endif
        </tr>
    </thead>
    <tbody class="table-light">
        @foreach($data_buku as $buku)
        <tr>
            <td>
                @if ( $buku->filepath )
                <div class="relative">
                    <img
                        class="h-full w-full rounded-full object-cover object-center"
                        src="{{ asset($buku->filepath) }}"
                        alt="" />
                </div>
                @endif
            </td>
            <td>{{ $buku->judul }}</td>
            <td>{{ $buku->penulis }}</td>
            <td class="text-danger text-decoration-line-through">
                {{ "Rp. ".number_format($buku->harga, 2, ',', '.') }}
            </td>
            <td>
                <a class="badge text-bg-success text-wrap my-2">
                {{ $buku->diskon ? $buku->diskon . '%' : '0%' }}
                </a>
                
            </td>
            <td class="text-success">
                Rp. {{ number_format($buku->hargaSetelahDiskon(), 2, ',', '.') }}
            </td>
            <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
            <td>
                @if(Auth::check() && Auth::user()->role == 'admin')
                <div class="row">
                    <div class="col-md-3 me-2">
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

<h2>Editorial Picks</h2>
<table class="table">
    <thead>
        <tr class="table-secondary">
            <th>Thumbnail</th>
            <th class="w-10">Judul Buku</th>
            <th>Penulis</th>
            <th>Harga</th>
            <th>Diskon</th>
            <th>Harga Baru</th>
            <th>Tanggal Terbit</th>
            @if(Auth::check() && Auth::user()->role == 'admin')
            <th>Aksi</th>
            @endif
        </tr>
    </thead>
    <tbody class="table-info">
        @foreach($editorialPicks as $buku)
        <tr>
            <td>
                @if ( $buku->filepath )
                <div class="relative">
                    <img
                        class="h-full w-full rounded-full object-cover object-center"
                        src="{{ asset($buku->filepath) }}"
                        alt="" />
                </div>
                @endif
            </td>
            <td>{{ $buku->judul }}</td>
            <td>{{ $buku->penulis }}</td>
            <td class="text-danger text-decoration-line-through">
                {{ "Rp. ".number_format($buku->harga, 2, ',', '.') }}
            </td>
            <td>
                <a class="badge text-bg-success text-wrap my-2">
                {{ $buku->diskon ? $buku->diskon . '%' : '0%' }}
                </a>
                
            </td>
            <td class="text-success">
                Rp. {{ number_format($buku->hargaSetelahDiskon(), 2, ',', '.') }}
            </td>
            <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
            <td>
                @if(Auth::check() && Auth::user()->role == 'admin')
                <div class="row">
                    <div class="col-md-3 me-2">
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

<div><strong>Jumlah Buku: {{ $jumlah_buku }}</strong></div>

<div>
    <p>Jumlah buku: {{ $totalbuku }}</p>
</div>

<div>
    <p>Total harga untuk semua buku: {{ "Rp. ".number_format($totalharga, 2, ',', '.') }}</p>
</div>

<div>
    <a href="{{ route('reviews.create') }}" class="btn btn-primary">Tambah Review</a>
</div>

@endsection