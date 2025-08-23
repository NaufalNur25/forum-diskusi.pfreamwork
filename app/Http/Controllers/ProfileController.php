<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;

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
}
