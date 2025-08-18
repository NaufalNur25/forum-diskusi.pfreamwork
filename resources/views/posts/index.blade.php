<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">MyApp</a>
            <div class="d-flex">
                <span class="navbar-text me-3">
                    Selamat datang, <strong>{{ Auth::user()->name }}</strong>
                </span>
                <form method="POST" action="{{ route('authentication.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Daftar Pertanyaan</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">Buat Post Baru</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @forelse ($posts as $post)
            <a href="{{ route('posts.show', $post) }}" class="card mb-3 text-decoration-none text-dark hover-shadow">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->question }}</h5>
                    <p class="card-text">{{ Str::limit($post->content, 150) }}</p>
                    <p class="card-text">
                        <small class="text-muted">
                            Dibuat oleh: <strong>{{ $post->user->name }}</strong> |
                            Kategori: <strong>{{ $post->category->name }}</strong> |
                            {{ $post->comments->count() }} Komentar
                        </small>
                    </p>
                </div>
            </a>
        @empty
            <div class="alert alert-info">
                Belum ada post yang dibuat.
            </div>
        @endforelse

        {{-- Tambahkan sedikit CSS untuk efek hover --}}
        <style>
            .hover-shadow {
                transition: box-shadow .2s ease-in-out;
            }

            .hover-shadow:hover {
                box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
            }
        </style>

    </div>

</body>

</html>
