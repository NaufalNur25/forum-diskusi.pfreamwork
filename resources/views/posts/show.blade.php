<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $post->question }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        {{-- (Salin kode navbar dari file index.blade.php jika diperlukan) --}}
        <div class="container">
            <a class="navbar-brand" href="{{ route('posts.index') }}">Kembali ke Daftar Post</a>
            {{-- ... --}}
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card mb-4">
                    <div class="card-body">
                        <h1 class="card-title fs-3">{{ $post->question }}</h1>
                        <div class="text-muted mb-3">
                            <small>
                                Ditanyakan oleh <strong>{{ $post->user->name }}</strong>
                                dalam kategori <strong>{{ $post->category->name }}</strong>
                                pada {{ $post->created_at->format('d M Y') }}
                            </small>
                        </div>
                        <hr>
                        <div class="fs-6">
                            {!! nl2br(e($post->content)) !!}
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">{{ $post->comments->count() }} Komentar</h4>

                        <div class="d-flex align-items-start mb-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random"
                                alt="Avatar" class="rounded-circle me-3" width="50" height="50">
                            <form action="{{ route('comments.store', $post) }}" method="POST" class="w-100">
                                @csrf
                                <div class="mb-2">
                                    <textarea class="form-control" name="comment" rows="2" placeholder="Tulis komentar Anda..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm float-end">Kirim</button>
                            </form>
                        </div>

                        @if ($post->comments->count() > 0)
                            <hr>
                        @endif

                        @forelse($post->comments->sortByDesc('created_at') as $comment)
                            <div class="d-flex align-items-start mb-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random"
                                    alt="Avatar" class="rounded-circle me-3" width="50" height="50">

                                <div class="w-100">
                                    <div class="bg-light rounded p-3">
                                        <div class="d-flex justify-content-between">
                                            <a href="#" class="text-decoration-none">
                                                <h6 class="fw-bold text-dark mb-0">{{ $comment->user->name }}</h6>
                                            </a>
                                            <small
                                                class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-0 mt-1">{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">Jadilah yang pertama berkomentar.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
