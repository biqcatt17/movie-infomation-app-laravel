<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TvShowComment extends Model
{
    protected $fillable = [
        'comment',
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