<?php
namespace App\Http\Controllers;
use App\Models\MovieRating;
use Illuminate\Http\Request;
class MovieRatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $movieId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5'
        ]);

        MovieRating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'movie_id' => $movieId
            ],
            ['rating' => $validated['rating']]
        );

        return back()->with('success', 'Rating submitted successfully!');
    }
}