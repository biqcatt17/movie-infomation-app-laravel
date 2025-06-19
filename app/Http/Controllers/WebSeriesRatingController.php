<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebSeriesRatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5'
        ]);

        // For now, just redirect back with success message since we're using dummy data
        return back()->with('success', 'Rating submitted successfully!');
    }
}