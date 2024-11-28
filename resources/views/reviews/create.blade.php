@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Formulir Review Buku</h1>
    <form action="{{ route('reviews.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="mb-3">
            <label for="buku" class="form-label">Pilih Buku</label>
            <select name="buku_id" id=buku_id" class="form-select" required>
                <option value="" disabled selected>Pilih buku...</option>
                @foreach ($books as $buku)
                <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Silakan pilih buku.
            </div>
        </div>

        <div class="mb-3">
            <label for="review" class="form-label">Review</label>
            <textarea name="review" id="review" class="form-control" rows="4" required></textarea>
            <div class="invalid-feedback">
                Review tidak boleh kosong.
            </div>
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tag (pisahkan dengan koma)</label>
            <input type="text" name="tags[]" id="tags" class="form-control" placeholder="Contoh: Petualangan, Epik, Fantasi" required>
            <div class="invalid-feedback">
                Silakan tambahkan setidaknya satu tag.
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection

<script>
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>