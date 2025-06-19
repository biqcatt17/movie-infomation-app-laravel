<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('layouts.app')

@section('title', $series->title)

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Web Series Poster -->
        <div class="col-md-4">
            <div class="card bg-dark border-0">
                <img src="{{ asset($series->poster) }}" class="card-img-top" alt="{{ $series->title }}">
            </div>
        </div>

        <!-- Web Series Details -->
        <div class="col-md-8">
            <div class="bg-dark text-white p-4 rounded">
                <h1>{{ $series->title }}</h1>
                <div class="mb-3">
                    <span class="badge bg-primary">{{ $series->year }}</span>
                    <span class="badge bg-secondary">{{ $series->seasons }} Seasons</span>
                    <span class="badge bg-success">IMDb {{ $series->imdb_rating }}</span>
                </div>
                <p class="lead">{{ $series->description }}</p>

                <!-- Trailer Section -->
                @if(isset($series->trailer_url))
                    <div class="trailer-section mt-4 mb-4">
                        <h3>Trailer</h3>
                        <div class="ratio ratio-16x9">
                            <iframe 
                                src="{{ $series->trailer_url }}"
                                title="{{ $series->title }} trailer"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                class="rounded">
                            </iframe>
                        </div>
                    </div>
                @endif

                <!-- Additional Details -->
                <dl class="row mt-4">
                    <dt class="col-sm-3">Creator</dt>
                    <dd class="col-sm-9">{{ $series->creator }}</dd>

                    <dt class="col-sm-3">Platform</dt>
                    <dd class="col-sm-9">{{ $series->platform }}</dd>

                    <dt class="col-sm-3">Release Date</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($series->release_date)->format('F j, Y') }}</dd>

                    <dt class="col-sm-3">Views</dt>
                    <dd class="col-sm-9">{{ number_format($series->views) }}</dd>

                    <dt class="col-sm-3">Cast</dt>
                    <dd class="col-sm-9">{{ $series->cast }}</dd>

                    <dt class="col-sm-3">Genre</dt>
                    <dd class="col-sm-9">{{ $series->genre }}</dd>

                    <dt class="col-sm-3">Language</dt>
                    <dd class="col-sm-9">{{ $series->language }}</dd>
                </dl>

                <div class="mt-4">
                    <h4>Storyline</h4>
                    <p>{{ $series->storyline }}</p>
                </div>

                <!-- Rating Section -->
                <div class="rating-section mt-4">
                    <h3>Rate this Web Series</h3>
                    @auth
                        <form action="{{ route('web-series.rate', $series->id) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="rating-stars">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}">
                                    <label for="star{{ $i }}">☆</label>
                                @endfor
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Submit Rating</button>
                        </form>
                    @else
                        <p>Please <a href="{{ route('login') }}">login</a> to rate this web series.</p>
                    @endauth

                    <div class="average-rating">
                        <h4>Average Rating: {{ number_format($series->average_rating ?? 0, 1) }}/5</h4>
                        <p>({{ $series->ratings->count() ?? 0 }} ratings)</p>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="comments-section mt-5">
                    <h3>Comments</h3>
                    @auth
                        <form action="{{ route('web-series.comments.store', $series->id) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="form-group">
                                <textarea name="comment" class="form-control" rows="3" placeholder="Leave a comment"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Post Comment</button>
                        </form>
                    @else
                        <p>Please <a href="{{ route('login') }}">login</a> to leave a comment.</p>
                    @endauth

                    @forelse($series->comments as $comment)
                        <div class="comment bg-secondary bg-opacity-25 p-3 mb-3 rounded">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $comment->user->name }}</strong>
                                <small>{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mt-2 mb-1">{{ $comment->comment }}</p>
                        </div>
                    @empty
                        <p class="text-muted">No comments yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-effect {
    transition: transform 0.3s ease-in-out;
}
.hover-effect:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
}
.card-img-top {
    height: 600px;
    object-fit: cover;
}
.badge {
    font-size: 0.9rem;
}

/* Rating Stars */
.rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
}

.rating input {
    display: none;
}

.rating label {
    cursor: pointer;
    font-size: 30px;
    color: #ddd;
    padding: 5px;
}

.rating input:checked ~ label {
    color: #ffd700;
}

.rating label:hover,
.rating label:hover ~ label {
    color: #ffd700;
}

/* Comment styles */
.comments-list {
    max-height: 600px;
    overflow-y: auto;
}

.comments-list::-webkit-scrollbar {
    width: 8px;
}

.comments-list::-webkit-scrollbar-track {
    background: #343a40;
}

.comments-list::-webkit-scrollbar-thumb {
    background: #666;
    border-radius: 4px;
}

.rating-stars {
    display: inline-flex;
    flex-direction: row-reverse;
    gap: 3px;
}

.rating-stars input {
    display: none;
}

.rating-stars label {
    font-size: 30px;
    color: #ddd;
    cursor: pointer;
}

.rating-stars input:checked ~ label,
.rating-stars label:hover,
.rating-stars label:hover ~ label {
    color: #ffd700;
}

.trailer-section {
    background: rgba(0, 0, 0, 0.2);
    padding: 20px;
    border-radius: 8px;
}

.trailer-section iframe {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
</style>
@endsection
</body>
</html>