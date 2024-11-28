@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Review dengan Tag: {{ $tag }}</h1>
    <ul class="list-group">
        @forelse ($reviews as $review)
            <li class="list-group-item">
                <strong>{{ $review->book->title }}</strong>: {{ $review->review }}
            </li>
        @empty
            <li class="list-group-item">Tidak ada review dengan tag: {{ $tag }}.</li>
        @endforelse
    </ul>
</div>
@endsection
