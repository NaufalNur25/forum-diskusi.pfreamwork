<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InteractionController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'like' => 'required|boolean',
        ]);

        $interactionType = $request->like;


        $existingInteraction = $post->interactions()->where('user_id', Auth::id())->first();

        if ($existingInteraction) {
            if ($existingInteraction->like == $interactionType) {
                $existingInteraction->delete();
            } else {
                $existingInteraction->update(['like' => $interactionType]);
            }
        } else {
            $post->interactions()->create([
                'user_id' => Auth::id(),
                'like' => $interactionType
            ]);
        }

        return back();
    }
}
