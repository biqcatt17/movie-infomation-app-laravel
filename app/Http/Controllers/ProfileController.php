<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user()->fresh(); // Get fresh user data
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'bio' => 'nullable|string|max:1000',
            'profile_picture' => 'nullable|image|max:1024'
        ]);

        try {
            if ($request->hasFile('profile_picture')) {
                // Delete old profile picture
                if ($user->profile_picture) {
                    Storage::disk('public')->delete($user->profile_picture);
                }
                
                $path = $request->file('profile_picture')->store('profile-pictures', 'public');
                $validated['profile_picture'] = $path;
            }

            $user->update($validated);
            
            // Refresh user data
            $user = $user->fresh();
            
            return redirect()->route('profile.index')
                           ->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update profile. Please try again.');
        }
    }
}
