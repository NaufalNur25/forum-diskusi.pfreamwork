<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Post::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('question', 'like', "%{$search}%");
        }

        if ($request->filled('category')) {
            $category = $request->category;
            $query->where('category_id', $category);
        }
        $query->withCount(['likes', 'comments']);
        $sort = $request->input('sort', 'latest');

        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'most_liked':
                $query->orderByDesc('likes_count');
                break;
            case 'most_commented':
                $query->orderByDesc('comments_count');
                break;
            default:
                $query->latest();
                break;
        }

        $posts = $query->with('user', 'category')->paginate(10);

        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'content' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('content')) {
            $path = $request->file('content')->store('posts', 'public');
            $validated['content'] = $path;
        }

        Post::create($validated);


        if ($request->wantsJson()) {

            return response()->json(['message' => 'Pertanyaan berhasil dibuat!'], 201);
        }


        return redirect()->route('posts.index')->with('success', 'Post berhasil dibuat!');
    }

    public function show(Post $post)
    {
        $post->loadCount(['likes', 'dislikes', 'comments', 'allReplies']);

        $post->load([
            'user',
            'category',
            'comments.user',

            'comments.answers.user',

            'comments.answers.parent.user',
        ]);

        $totalInteractionCount = $post->comments_count + $post->all_replies_count;

        return view('posts.show', [
            'post' => $post,
            'totalInteractionCount' => $totalInteractionCount
        ]);
    }
}
