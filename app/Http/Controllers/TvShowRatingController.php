<?php
namespace App\Http\Controllers;
use App\Models\TVShowRating;
use Illuminate\Http\Request;
class TvShowRatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request, $tvShowId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5'
        ]);
        TVShowRating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'tv_show_id' => $tvShowId
            ],
            ['rating' => $validated['rating']]
        );
        return back()->with('success', 'Rating submitted successfully!');
    }
}