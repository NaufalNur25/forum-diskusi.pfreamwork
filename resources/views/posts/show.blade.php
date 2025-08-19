<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->question }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>

<body class="bg-slate-50 font-sans">

    <nav class="bg-blue-600 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <a href="{{ route('posts.index') }}"
                        class="text-white font-semibold hover:text-blue-200 transition-colors duration-200 flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Kembali</span>
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    <span class="text-white hidden sm:block">
                        Selamat datang, <strong class="font-semibold">{{ Auth::user()->name }}</strong>
                    </span>
                    <form method="POST" action="{{ route('authentication.logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-white text-blue-600 font-semibold px-4 py-2 rounded-lg shadow-sm hover:bg-blue-50 transition-colors duration-200">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="space-y-6">

            <div class="bg-white rounded-xl shadow-md overflow-hidden">

                {{-- CEK & TAMPILKAN GAMBAR JIKA ADA --}}
                @if ($post->content)
                    <div class="w-3/4 aspect-video mx-auto">
                        <img class="h-full w-full object-contain" src="{{ asset('storage/' . $post->content) }}"
                            alt="Gambar untuk pertanyaan: {{ $post->question }}">
                    </div>
                @endif

                <div class="p-6">
                    <h1 class="text-3xl font-bold text-slate-800">{{ $post->question }}</h1>
                    <div class="text-sm text-slate-500 mt-2">
                        Ditanyakan oleh <strong class="text-slate-700">{{ $post->user->name }}</strong>
                        dalam kategori <strong class="text-slate-700">{{ $post->category->name }}</strong>
                        pada {{ $post->created_at->format('d M Y') }}
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-slate-800 mb-4">{{ $post->comments->count() }} Komentar</h2>

                    <div class="flex items-start space-x-4 mb-6">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff"
                            alt="Avatar" class="rounded-full h-12 w-12">
                        <form action="{{ route('comments.store', $post) }}" method="POST"
                            class="w-full flex flex-col items-end">
                            @csrf
                            <textarea class="w-full border-slate-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" name="comment"
                                rows="2" placeholder="Tulis komentar Anda..." required></textarea>
                            <button type="submit"
                                class="mt-2 bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg shadow-sm hover:bg-blue-700 transition-colors duration-200">
                                Kirim
                            </button>
                        </form>
                    </div>

                    @if ($post->comments->count() > 0)
                        <hr class="my-4">
                    @endif

                    <div class="space-y-4">
                        @forelse($post->comments->sortByDesc('created_at') as $comment)
                            <div class="flex items-start space-x-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random&color=fff"
                                    alt="Avatar" class="rounded-full h-12 w-12">
                                <div class="bg-slate-100 rounded-lg p-3 w-full">
                                    <div class="flex justify-between items-center">
                                        <span class="font-semibold text-slate-800">{{ $comment->user->name }}</span>
                                        <small
                                            class="text-slate-500 text-xs">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="text-slate-700 mt-1">{{ $comment->comment }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-slate-500 py-4">Jadilah yang pertama berkomentar.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
