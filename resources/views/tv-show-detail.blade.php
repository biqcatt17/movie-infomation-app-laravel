<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- TV Show Poster -->
        <div class="col-md-4">
            <div class="card bg-dark border-0">
                @if(isset($tvShow) && isset($tvShow->poster))
                    <img src="{{ asset($tvShow->poster) }}" class="card-img-top" alt="{{ $tvShow->title }}">
                @endif
            </div>
        </div>

        <!-- TV Show Details -->
        <div class="col-md-8">
            <div class="bg-dark text-white p-4 rounded">
                <h1>{{ $tvShow->title ?? 'TV Show Details' }}</h1>
                @if(isset($tvShow))
                    <p class="lead">{{ $tvShow->description }}</p>
                    <div class="mb-3">
                        <span class="badge bg-primary">{{ $tvShow->year }}</span>
                        <span class="badge bg-secondary">{{ $tvShow->seasons }} Seasons</span>
                        <span class="badge bg-success">IMDb {{ $tvShow->imdb_rating }}</span>
                    </div>
                    
                    <div class="mt-4">
                        <h4>Details</h4>
                        <dl class="row">
                            <dt class="col-sm-3">Director</dt>
                            <dd class="col-sm-9">{{ $tvShow->director }}</dd>
                            
                            <dt class="col-sm-3">Cast</dt>
                            <dd class="col-sm-9">{{ $tvShow->cast }}</dd>
                            
                            <dt class="col-sm-3">Genre</dt>
                            <dd class="col-sm-9">{{ $tvShow->genre }}</dd>
                            
                            <dt class="col-sm-3">Language</dt>
                            <dd class="col-sm-9">{{ $tvShow->language }}</dd>
                        </dl>
                    </div>

                    @if($tvShow->trailer_embed_url)
                    <div class="mt-4">
                        <h4>Trailer</h4>
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $tvShow->trailer_embed_url }}" 
                                    allowfullscreen 
                                    class="rounded">
                            </iframe>
                        </div>
                    </div>
                    @endif

                    <!-- Rating Section -->
                    <div class="rating-section mt-4">
                        <h3>Rate this TV Show</h3>
                        @auth
                            <form action="{{ route('tv-shows.rate', $tvShow->id) }}" method="POST" class="mb-4">
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
                            <p>Please <a href="{{ route('login') }}">login</a> to rate this TV show.</p>
                        @endauth

                        <div class="average-rating">
                            <h4>Average Rating: {{ number_format($tvShow->average_rating ?? 0, 1) }}/5</h4>
                            <p>({{ $tvShow->ratings->count() ?? 0 }} ratings)</p>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="comments-section mt-5">
                        <h3>Comments</h3>
                        @auth
                            <form action="{{ route('tv-shows.comments.store', $tvShow->id) }}" method="POST" class="mb-4">
                                @csrf
                                <div class="form-group">
                                    <textarea name="comment" class="form-control" rows="3" placeholder="Leave a comment"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Post Comment</button>
                            </form>
                        @endauth

                        @forelse($tvShow->comments as $comment)
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
                @endif
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

    </style>
</div>
@endsection
</body>
</html>