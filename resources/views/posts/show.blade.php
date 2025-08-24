@extends('Layouts.app')

@section('content')
    <main class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-6">
        {{-- Question Details Section --}}
        <section class="bg-white rounded-xl shadow-md overflow-hidden">
            @if ($post->content)
                <div class="w-full aspect-video bg-slate-200">
                    <img class="h-full w-full object-cover" src="{{ asset('storage/' . $post->content) }}"
                        alt="Image for question: {{ $post->question }}">
                </div>
            @endif
            <div class="p-6">
                <h1 class="text-3xl font-bold text-slate-800 mb-4">{{ $post->question }}</h1>
                <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
                    <div class="text-sm text-slate-500">
                        Asked by <strong class="text-slate-700">{{ $post->user->name }}</strong>
                        in category <strong class="text-slate-700">{{ $post->category->name }}</strong>
                        on {{ $post->created_at->format('d M Y') }}
                    </div>
                    <div class="flex-shrink-0 flex items-center gap-x-6 text-slate-600">
                        <form action="{{ route('posts.interact', $post) }}" method="POST">
                            @csrf
                            <input type="hidden" name="like" value="1">
                            <button type="submit"
                                class="flex items-center gap-x-1 hover:text-green-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.562 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.821 2.311l-1.055 1.58A2 2 0 006 10.333z" />
                                </svg>
                                <span class="font-semibold text-sm">{{ $post->likes_count }} Likes</span>
                            </button>
                        </form>
                        <form action="{{ route('posts.interact', $post) }}" method="POST">
                            @csrf
                            <input type="hidden" name="like" value="0">
                            <button type="submit"
                                class="flex items-center gap-x-1 hover:text-red-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.057 2H5.642a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.438 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.821-2.311l1.055-1.58A2 2 0 0014 9.667z" />
                                </svg>
                                <span class="font-semibold text-sm">{{ $post->dislikes_count }} Dislikes</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        {{-- Comments Section --}}
        <section class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-slate-800 mb-4">{{ $totalInteractionCount }} Comments & Replies</h2>
                <div class="flex items-start space-x-4 mb-6">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff"
                        alt="Avatar" class="rounded-full h-12 w-12">
                    <form action="{{ route('comments.store', $post) }}" method="POST" enctype="multipart/form-data"
                        class="w-full flex flex-col items-end">
                        @csrf
                        <textarea class="w-full border-slate-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" name="comment"
                            rows="2" placeholder="Write your comment..."></textarea>
                        <div class="w-full flex justify-between items-center mt-2">
                            <input type="file" name="content"
                                class="text-sm text-slate-500 file:mr-2 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <button type="submit"
                                class="bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg shadow-sm hover:bg-blue-700">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
                @if ($post->comments->isNotEmpty())
                    <hr class="my-4">
                @endif
                <div class="space-y-4">
                    @foreach ($post->comments->sortBy('created_at') as $comment)
                        @include('posts._comment', ['comment' => $comment])
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <script>
        function toggleReplyForm(id) {
            document.getElementById('reply-form-' + id).classList.toggle('hidden');
        }
    </script>
@endsection
