<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'nullable|string',
            'content' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (!$request->filled('comment') && !$request->hasFile('content')) {
            return back()->withErrors(['comment' => 'Komentar atau gambar tidak boleh kosong.']);
        }


        $data = [
            'user_id' => Auth::id(),
            'post_id' => $post->post_id,
            'comment' => $request->comment,
        ];


        if ($request->hasFile('content')) {
            $path = $request->file('content')->store('comments', 'public');
            $data['content'] = $path;
        }

        $post->comments()->create($data);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
