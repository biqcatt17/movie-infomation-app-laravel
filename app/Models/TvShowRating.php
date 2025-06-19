<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TVShowRating extends Model
{
    protected $table = 'tv_show_ratings';

    protected $fillable = [
        'rating',
        'user_id',
        'tv_show_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tvShow()
    {
        return $this->belongsTo(TvShow::class);
    }
}