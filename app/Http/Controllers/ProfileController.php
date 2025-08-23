<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function view()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/');
        }

        $posts = Post::with(['category', 'user'])
            ->withCount(['comments', 'allReplies', 'likes', 'dislikes'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('Profile.view', compact('user', 'posts'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('Profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'biograph' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->photo = $path;
        }

        $user->name = $request->name;
        $user->biograph = $request->biograph;
        $user->description = $request->description;
        $user->save();

        return redirect()->route('Profile.view')->with('success', 'Profile updated successfully!');
    }
}
