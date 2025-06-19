<?php
// app/Models/Movie.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'poster',
        'release_date',
        'duration',
        'imdb_rating',
        'views',
        'genre',
        'director',
        'cast',
        'language',
        'category',
        'storyline',
        'trailer_embed_url'
    ];

    // Define relationships
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie', 'movie_id', 'genre_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'movie_category', 'movie_id', 'category_id');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function watchHistories()
    {
        return $this->hasMany(WatchHistory::class);
    }

    public function comments()
    {
        return $this->hasMany(MovieComment::class, 'movie_id');
    }

    public function ratings()
    {
        return $this->hasMany(MovieRating::class);
    }

    public function getAverageRatingAttribute()
    {
        $ratings = $this->ratings()->get();
        if ($ratings->isEmpty()) {
            return 0;
        }
        return round($ratings->avg('rating'), 1);
    }

    // Add this accessor
    public function getRateAttribute()
    {
        return $this->getAverageRatingAttribute();
    }
}