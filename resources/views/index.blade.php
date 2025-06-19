<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOSMERL Movie Streaming</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('asset/bootstrap-5.3.6/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
</head>
<body class="bg-dark">
@extends('layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="hero position-relative" style="margin-top: 76px; height: 1000px; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('asset/images/hero-bg.jpg') }}') no-repeat center center; background-size: cover;">
        <div class="container h-100 d-flex align-items-center">
            <div class="col-lg-6 text-white">
                <h1 class="display-4 fw-bold mb-4">Unlimited Movies & TV Shows</h1>
                <p class="lead mb-4">Watch anywhere. Stream movies and TV shows on your phone, tablet, laptop, and TV.</p>
                <a href="{{ route('movies') }}" class="btn btn-primary btn-lg px-5">Watch Now</a>
            </div>
        </div>
    </section>

    <!-- Featured Content -->
    <div class="container mt-5">
        <!-- Watch Now Banner -->
        <div class="mb-4 p-4 bg-black rounded shadow">
            <h2 class="text-white mb-0">Watch Now</h2>
        </div>

        <!-- Movie Grid -->
        <div class="row g-4">
            @foreach($movies as $movie)
                <div class="col-md-3 mb-4">
                    <div class="card bg-black text-white border-0 h-100">
                        <img src="{{ asset($movie->poster) }}" class="card-img-top" alt="{{ $movie->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            <p class="card-text">
                                <small class="text-muted">{{ $movie->release_date }}</small>
                                <span class="float-end text-warning">
                                    @if(isset($movie->rate))
                                        {{ number_format($movie->rate, 1) }}
                                        <i class="fas fa-star"></i>
                                    @else
                                        No ratings
                                    @endif
                                </span>
                            </p>
                            <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-primary btn-sm w-100">Watch Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection
</body>
</html>