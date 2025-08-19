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
    public function index(Request $request) // <-- Tambahkan Request
    {
        // Ambil semua kategori untuk ditampilkan di dropdown filter
        $categories = Category::all();

        // Mulai query builder untuk Post
        $query = Post::query();

        // 1. Filter berdasarkan kata kunci (search)
        // Cek apakah ada input 'search' dari form
        if ($request->filled('search')) {
            $search = $request->search;
            // Tambahkan kondisi where untuk mencari di kolom 'question'
            $query->where('question', 'like', "%{$search}%");
        }

        // 2. Filter berdasarkan kategori
        // Cek apakah ada input 'category' dari form
        if ($request->filled('category')) {
            $category = $request->category;
            // Tambahkan kondisi where untuk mencari berdasarkan 'category_id'
            $query->where('category_id', $category);
        }

        // 3. Ambil hasil query yang sudah difilter
        $posts = $query->with('user', 'category')
                       ->withCount('comments')
                       ->latest()
                       ->paginate(10); // Menggunakan paginate untuk halaman

        // 4. Kirim data post yang sudah difilter dan semua kategori ke view
        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories
        ]);
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
    // 1. Validasi input, termasuk validasi untuk gambar
    $validated = $request->validate([
        'question' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,category_id',
        'content' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $validated['user_id'] = Auth::id();

    if ($request->hasFile('content')) {

        $path = $request->file('content')->store('posts', 'public');

        // Ganti nilai 'content' dengan path gambar yang disimpan
        $validated['content'] = $path;
    }

    // 4. Buat dan simpan post
    Post::create($validated);

    // 5. Redirect ke halaman daftar post dengan pesan sukses
    return redirect()->route('posts.index')->with('success', 'Post berhasil dibuat!');
}

    public function show(Post $post)
    {
        $post->load('user', 'category', 'comments.user');

        return view('posts.show', ['post' => $post]);
    }
}
