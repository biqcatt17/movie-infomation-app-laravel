<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->title ?? 'Movie Details' }} - Your Movie Streaming App</title>
    <link href="{{ asset('asset/bootstrap-5.3.6/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">

</head>
<body>
    @extends('layouts.app')

    @section('title', $movie->title)

    @section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Movie Poster -->
            <div class="col-md-4">
                <div class="card bg-dark border-0">
                    <img src="{{ asset($movie->poster) }}" class="card-img-top" alt="{{ $movie->title }}">
                </div>
            </div>

            <!-- Movie Details -->
            <div class="col-md-8">
                <div class="bg-dark text-white p-4 rounded">
                    <h1>{{ $movie->title }}</h1>
                    <div class="mb-3">
                        <span class="badge bg-primary">{{ $movie->release_date }}</span>
                        <span class="badge bg-secondary">{{ $movie->duration }}</span>
                        <span class="badge bg-success">IMDb {{ $movie->imdb_rating }}</span>
                    </div>
                    <p class="lead">{{ $movie->description }}</p>

                    <!-- Trailer Section -->
                    @if(isset($movie->trailer_embed_url))
                        <div class="trailer-section mt-4 mb-4">
                            <h3>Movie Trailer</h3>
                            <div class="ratio ratio-16x9">
                                <iframe 
                                    src="{{ $movie->trailer_embed_url }}"
                                    title="{{ $movie->title }} trailer"
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
                        <dt class="col-sm-3">Director</dt>
                        <dd class="col-sm-9">{{ $movie->director }}</dd>

                        <dt class="col-sm-3">Release Date</dt>
                        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($movie->release_date)->format('F j, Y') }}</dd>

                        <dt class="col-sm-3">Cast</dt>
                        <dd class="col-sm-9">{{ $movie->cast }}</dd>

                        <dt class="col-sm-3">Genre</dt>
                        <dd class="col-sm-9">{{ $movie->genre }}</dd>

                        <dt class="col-sm-3">Language</dt>
                        <dd class="col-sm-9">{{ $movie->language }}</dd>

                        <dt class="col-sm-3">Duration</dt>
                        <dd class="col-sm-9">{{ $movie->duration }}</dd>
                    </dl>

                    @if(isset($movie->storyline))
                    <div class="mt-4">
                        <h4>Storyline</h4>
                        <p>{{ $movie->storyline }}</p>
                    </div>
                    @endif

                    <!-- Rating Section -->
                    <div class="rating-section mt-4">
                        <h3>Rate this Movie</h3>
                        @auth
                            <form action="{{ route('movies.rate', $movie->id) }}" method="POST" class="mb-4">
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
                            <p>Please <a href="{{ route('login') }}">login</a> to rate this movie.</p>
                        @endauth

                        <div class="average-rating">
                            <h4>Average Rating: {{ number_format($movie->average_rating ?? 0, 1) }}/5</h4>
                            <p>({{ $movie->ratings->count() ?? 0 }} ratings)</p>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="comments-section mt-4">
                        <h3 class="text-white">Comments</h3>
                        
                        <!-- Comment Form -->
                        @auth
                        <form action="{{ route('movies.comments.store', ['movie' => $movie->id]) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="form-group">
                                <textarea name="comment" class="form-control bg-dark text-white" rows="3" placeholder="Add a comment..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Post Comment</button>
                        </form>
                        @endauth

                        <!-- Display Comments -->
                        <div class="comments-list">
                            @foreach($movie->comments as $comment)
                                <div class="comment-item bg-dark text-white p-3 mb-3 rounded">
                                    <div class="d-flex justify-content-between">
                                        <strong>{{ $comment->user->name }}</strong>
                                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mt-2 mb-0">{{ $comment->comment }}</p>
                                </div>
                            @endforeach
                        </div>
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

    .trailer-section {
        background: rgba(0, 0, 0, 0.2);
        padding: 20px;
        border-radius: 8px;
    }

    .trailer-section iframe {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .comments-section {
        max-width: 800px;
        margin: 0 auto;
    }

    .comment {
        border-left: 3px solid #007bff;
        transition: transform 0.2s;
    }

    .comment:hover {
        transform: translateX(5px);
    }

    textarea.bg-dark {
        border: 1px solid #444;
    }

    textarea.bg-dark:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    .comment-item {
        border: 1px solid #2d2d2d;
        transition: all 0.3s ease;
    }

    .comment-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    textarea.form-control {
        border: 1px solid #2d2d2d;
    }

    textarea.form-control:focus {
        background-color: #2d2d2d;
        color: white;
        border-color: #375a7f;
        box-shadow: none;
    }
    </style>
    @endsection
</body>
</html>