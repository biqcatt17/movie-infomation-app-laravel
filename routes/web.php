<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TVShowController;
use App\Http\Controllers\WebSeriesController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TvShowCommentController;
use App\Http\Controllers\TVShowRatingController;
use App\Http\Controllers\WebSeriesCommentController;
use App\Http\Controllers\WebSeriesRatingController;
use App\Http\Controllers\MovieCommentController;
use App\Http\Controllers\MovieRatingController;

// Home route
Route::get('/home', [MovieController::class, 'index'])->name('home');

// Authentication Routes
Auth::routes();

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/home', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/home', [ProfileController::class, 'update'])->name('profile.update');
    });
    
    // Comment routes
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
    // Rating routes
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
    Route::post('/tv-shows/{id}/rate', [TVShowRatingController::class, 'store'])->name('tv-shows.rate');
    Route::post('/web-series/{id}/rate', [WebSeriesRatingController::class, 'store'])->name('web-series.rate');
    Route::post('/movies/{id}/rate', [MovieRatingController::class, 'store'])->name('movies.rate');
    
    // Other authenticated routes...
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::post('/movies/{id}/comments', [MovieCommentController::class, 'store'])->name('movies.comments.store');
    Route::delete('/movies/comments/{comment}', [MovieCommentController::class, 'destroy'])->name('movies.comments.destroy');
    
    // Web Series Comments Routes
    Route::post('/web-series/{id}/comments', [WebSeriesCommentController::class, 'store'])
        ->name('web-series.comments.store');
});
// Public Routes
Route::get('/movies', [MovieController::class, 'movies'])->name('movies');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/tv-shows', [TVShowController::class, 'index'])->name('tv-shows');
Route::get('/tv-shows/{id}', [TVShowController::class, 'show'])->name('tv-shows.show');
Route::get('/web-series', [WebSeriesController::class, 'index'])->name('web-series');
Route::get('/web-series/{id}', [WebSeriesController::class, 'show'])->name('web-series.show');
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/tv-shows/{show}', [TVShowController::class, 'show'])->name('tv-shows.details');
Route::post('/tv-shows/{show}', [TVShowController::class, 'store'])->name('tv-shows.details.store');

// Add this route for TV show comments
Route::post('/tv-shows/{id}/comments', [TvShowCommentController::class, 'store'])
    ->name('tv-shows.comments.store')
    ->middleware('auth');

// Route for storing movie comments (authenticated users only)
Route::post('/movies/{movie}/comments', [MovieCommentController::class, 'store'])
    ->name('movies.comments.store')
    ->middleware('auth');