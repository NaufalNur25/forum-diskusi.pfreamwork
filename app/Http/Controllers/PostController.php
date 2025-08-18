<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Tampilkan semua post yang ada.
     */
    public function index()
    {
        // Ambil semua post, urutkan dari yang terbaru
        // 'with' digunakan untuk Eager Loading, agar query lebih efisien
        $posts = Post::with('user', 'category')->latest()->get();

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Tampilkan formulir untuk membuat post baru.
     */
    public function create()
    {
        // Ambil semua kategori untuk ditampilkan di form
        $categories = Category::all();
        return view('posts.create', ['categories' => $categories]);
    }

    /**
     * Simpan post baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id', // Pastikan category_id ada di tabel categories
            'content' => 'nullable|string',
        ]);

        // 2. Tambahkan user_id dari user yang sedang login
        $validated['user_id'] = Auth::id();

        // 3. Buat dan simpan post
        Post::create($validated);

        // 4. Redirect ke halaman daftar post dengan pesan sukses
        return redirect()->route('posts.index')->with('success', 'Post berhasil dibuat!');
    }

    public function show(Post $post)
    {
        $post->load('user', 'category', 'comments.user');

        return view('posts.show', ['post' => $post]);
    }
}
