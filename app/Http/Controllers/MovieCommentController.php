<?php
namespace App\Http\Controllers;
use App\Models\MovieComment;
use App\Models\Movie;
use Illuminate\Http\Request;
class MovieCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Movie  $movie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000'
        ]);

        try {
            MovieComment::create([
                'comment' => $validated['comment'],
                'user_id' => auth()->id(),
                'movie_id' => $movie->id
            ]);

            return back()->with('success', 'Comment posted successfully!');
        } catch (\Exception $e) {
            \Log::error('Comment creation failed: ' . $e->getMessage());
            return back()->with('error', 'Unable to post comment. Please try again.');
        }
    }

    public function index($movieId)
    {
        $movie = Movie::findOrFail($movieId);
        $comments = $movie->comments()->with('user')->latest()->get();
        return response()->json($comments);
    }
}

class MovieController extends Controller
{
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }
}