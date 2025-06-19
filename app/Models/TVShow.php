<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TVShow extends Model
{
    // ...existing code...

    public function comments()
    {
        return $this->hasMany(TvShowComment::class);
    }

    public function ratings()
    {
        return $this->hasMany(TvShowRating::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }
}