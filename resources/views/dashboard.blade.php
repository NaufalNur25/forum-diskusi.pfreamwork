<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">MyApp</a>
        <div class="d-flex">
            @auth
                <span class="navbar-text me-3">
                    Selamat datang, <strong>{{ Auth::user()->name }}</strong>
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h1>Dashboard</h1>
    <p>Anda berhasil login!</p>
</div>

</body>
</html>
