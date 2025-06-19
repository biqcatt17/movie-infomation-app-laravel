<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TvShowCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000'
        ]);

        // Since we're using dummy data, just redirect back with success message
        return back()->with('success', 'Comment posted successfully!');
    }
}