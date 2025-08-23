@props(['post'])

<div class="flex flex-col bg-white rounded-xl shadow-md overflow-hidden">
    @if ($post->content)
        <a href="{{ route('posts.show', $post) }}" class="block">
            <div class="w-1/2 aspect-video mx-auto">
                <img class="h-full w-full object-cover" src="{{ asset('storage/' . $post->content) }}"
                    alt="Image for question: {{ Str::limit($post->question, 50) }}">
            </div>
        </a>
    @endif

    <div class="p-6">
        <h2 class="text-xl font-bold text-slate-800 mb-2">
            <a href="{{ route('posts.show', $post) }}" class="hover:underline">
                {{ $post->question }}
            </a>
        </h2>

        <div class="flex items-center text-sm text-slate-500 mb-4">
            <span>Created by: <strong class="text-slate-700">{{ $post->user->name }}</strong></span>
            <span class="mx-2">•</span>
            <span>Category: <strong class="text-slate-700">{{ $post->category->name }}</strong></span>
        </div>

        <div class="flex items-center justify-between text-sm text-slate-500">
            <div class="flex items-center gap-x-4">
                <form action="{{ route('posts.interact', $post) }}" method="POST">
                    @csrf
                    <input type="hidden" name="like" value="1">
                    <button type="submit" class="flex items-center gap-x-1 hover:text-green-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.562 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.821 2.311l-1.055 1.58A2 2 0 006 10.333z" />
                        </svg>
                        <span>{{ $post->likes_count }}</span>
                    </button>
                </form>

                <form action="{{ route('posts.interact', $post) }}" method="POST">
                    @csrf
                    <input type="hidden" name="like" value="0">
                    <button type="submit" class="flex items-center gap-x-1 hover:text-red-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.057 2H5.642a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.438 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.821-2.311l1.055-1.58A2 2 0 0014 9.667z" />
                        </svg>
                        <span>{{ $post->dislikes_count }}</span>
                    </button>
                </form>
            </div>

            <div class="text-slate-500">
                <a href="{{ route('posts.show', $post) }}" class="hover:underline">
                    <span>{{ $post->comments_count + $post->all_replies_count }} Comments</span>
                </a>
            </div>
        </div>
    </div>
</div>
