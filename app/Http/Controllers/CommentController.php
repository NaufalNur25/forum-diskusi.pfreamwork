<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Menyimpan komentar baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Post $post)
    {
        // 1. Validasi input dari form
        $request->validate([
            'comment' => 'required|string|min:3',
        ]);

        // 2. Gunakan relasi untuk membuat komentar baru
        // Ini cara yang lebih baik karena otomatis mengisi `commentable_id` dan `commentable_type`
        $post->comments()->create([
            'comment' => $request->comment,
            'user_id' => Auth::id(), // Ambil ID user yang sedang login
        ]);

        // 3. Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}
