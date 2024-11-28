@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Review oleh {{ $user->name }}</h1>
    <ul class="list-group">
        @forelse ($reviews as $review)
            <li class="list-group-item">
                <strong>{{ $review->book->title }}</strong>: {{ $review->review }}
            </li>
        @empty
            <li class="list-group-item">Belum ada review oleh {{ $user->name }}.</li>
        @endforelse
    </ul>
</div>
@endsection
