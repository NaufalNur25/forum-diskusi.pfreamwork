<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Pertanyaan</title>

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
                    <a href="#" class="text-white text-2xl font-bold">MyApp</a>
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

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-slate-800">Daftar Pertanyaan</h1>
            <a href="{{ route('posts.create') }}"
                class="bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-200 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                <span>Buat Pertanyaan</span>
            </a>
        </div>

        <div class="bg-white p-4 rounded-xl shadow-sm mb-6">
            <form action="{{ route('posts.index') }}" method="GET"
                class="flex flex-col sm:flex-row items-center gap-4">

                <div class="flex-grow w-full sm:w-auto">
                    <input type="text" name="search" placeholder="Cari berdasarkan judul..."
                        value="{{ request('search') }}"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="w-full sm:w-56">
                    <select name="category"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}"
                                {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex-shrink-0 flex items-center space-x-2">
                    <a href="{{ route('posts.index') }}"
                        class="text-slate-600 font-semibold px-4 py-2 rounded-lg hover:bg-slate-100 transition-colors">Reset</a>
                    <button type="submit"
                        class="bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md hover:bg-blue-700 transition-colors">Filter</button>
                </div>

            </form>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6" role="alert">
                <p class="font-bold">Sukses!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="space-y-4">
            @forelse ($posts as $post)
                <div class="flex flex-col bg-white rounded-xl shadow-md overflow-hidden">

                    @if ($post->content)
                        <a href="{{ route('posts.show', $post) }}" class="block">
                            <div class="w-1/2 aspect-video mx-auto">

                                <img class="h-full w-full object-cover" src="{{ asset('storage/' . $post->content) }}"
                                    alt="Gambar untuk pertanyaan: {{ Str::limit($post->question, 50) }}">
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
                            <span>Dibuat oleh: <strong class="text-slate-700">{{ $post->user->name }}</strong></span>
                            <span class="mx-2">•</span>
                            <span>Kategori: <strong class="text-slate-700">{{ $post->category->name }}</strong></span>
                        </div>

                        <div class="flex items-center justify-between text-sm text-slate-500">
                            <div class="flex items-center gap-x-4">
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
                                        <span>{{ $post->likes_count }}</span>
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
                                        <span>{{ $post->dislikes_count }}</span>
                                    </button>
                                </form>
                            </div>

                            <div class="text-slate-500">
                                <a href="{{ route('posts.show', $post) }}" class="hover:underline">
                                    <span>{{ $post->comments_count + $post->all_replies_count }} Komentar</span>
                                </a>
                            </div>
                        </div>
                    </div>
            </div> @empty
                <div class="col-span-full text-center ...">
                </div>
            @endforelse
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $posts->appends(request()->query())->links() }}
    </div>

</body>

</html>
