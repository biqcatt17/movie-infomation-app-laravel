<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebSeries extends Model
{
    protected $fillable = [
        'title',
        'poster',
        'year',
        'seasons',
        'platform',
        'views',
        'release_date',
        'genre',
        'creator',
        'cast',
        'language',
        'imdb_rating',
        'description',
        'storyline',
        'trailer_embed_url'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'series_id');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'series_id');
    }
}