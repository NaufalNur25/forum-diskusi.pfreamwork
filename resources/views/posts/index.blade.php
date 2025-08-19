<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Pertanyaan</title>

    <!-- Memuat Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Memuat Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Konfigurasi kustom untuk Tailwind -->
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
        /* Menambahkan sedikit style tambahan untuk body */
        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>

<body class="bg-slate-50 font-sans">

    <!-- Navbar -->
    <nav class="bg-blue-600 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo/Brand -->
                <div class="flex-shrink-0">
                    <a href="#" class="text-white text-2xl font-bold">MyApp</a>
                </div>

                <!-- Info Pengguna dan Tombol Logout -->
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

    <!-- Konten Utama -->
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

        <!-- Header Halaman -->
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

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6" role="alert">
                <p class="font-bold">Sukses!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Daftar Postingan -->
        <div class="space-y-4">
            @forelse ($posts as $post)
                <a href="{{ route('posts.show', $post) }}"
                    class="flex flex-col bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 ease-in-out">

                    @if ($post->content)
                        <div class="w-1/2 aspect-video mx-auto">
                            <img class="h-full w-full object-cover" src="{{ asset('storage/' . $post->content) }}"
                                alt="Gambar untuk pertanyaan: {{ Str::limit($post->question, 50) }}">
                        </div>
                    @endif

                    <div class="p-6">
                        <h2 class="text-xl font-bold text-slate-800 mb-2">{{ $post->question }}</h2>

                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-slate-500">
                            <span>Dibuat oleh: <strong class="text-slate-700">{{ $post->user->name }}</strong></span>
                            <span class="hidden sm:inline">|</span>
                            <span>Kategori: <strong class="text-slate-700">{{ $post->category->name }}</strong></span>
                            <span class="hidden sm:inline">|</span>
                            <span>{{ $post->comments->count() }} Komentar</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center bg-blue-100 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md"
                    role="alert">
                    <p class="font-bold">Belum ada pertanyaan.</p>
                    <p class="text-sm">Jadilah yang pertama membuat pertanyaan baru!</p>
                </div>
            @endforelse


        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $posts->appends(request()->query())->links() }}
    </div>

</body>

</html>
