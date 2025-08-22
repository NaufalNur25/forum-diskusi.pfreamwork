<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function store(Request $request, Comment $comment)
{
    $validatedData = $request->validate([
        'answer' => 'nullable|string',
        'content' => 'nullable|image|max:2048',
        'parent_id' => 'nullable|exists:answers,answer_id',
    ]);

    if (empty($validatedData['answer']) && !$request->hasFile('content')) {
        return back()->withErrors(['answer' => 'Balasan atau gambar tidak boleh kosong.']);
    }

    $dataToCreate = [
        'user_id' => Auth::id(),
        'answer' => $request->answer,
    ];

    if ($request->filled('parent_id')) {
        $dataToCreate['parent_id'] = $request->parent_id;
    } else {
        $dataToCreate['parent_id'] = null;
    }

    if ($request->hasFile('content')) {
        $dataToCreate['content'] = $request->file('content')->store('answers', 'public');
    }

    $comment->answers()->create($dataToCreate);

    return back()->with('success', 'Balasan berhasil dikirim!');
}
}
