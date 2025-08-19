<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pertanyaan Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- (kode head lainnya tidak berubah) --}}
</head>
<body class="bg-slate-50 font-sans">
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

    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 sm:p-8">
                <h1 class="text-2xl font-bold text-slate-800 mb-6">Buat Pertanyaan Baru</h1>
                <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label for="question" class="block text-sm font-medium text-slate-700">Pertanyaan</label>
                        {{-- PERBAIKAN DI BAWAH INI --}}
                        <input type="text" name="question" id="question" value="{{ old('question') }}" required
                               class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm {{ $errors->has('question') ? 'border-red-500' : 'border-slate-300' }}">
                        @error('question')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-slate-700">Kategori</label>
                        {{-- PERBAIKAN DI BAWAH INI --}}
                        <select name="category_id" id="category_id" required
                                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm {{ $errors->has('category_id') ? 'border-red-500' : 'border-slate-300' }}">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}" {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-slate-700">Upload Gambar (Opsional)</label>
                        <input type="file" name="content" id="content"
                               class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('content') ring-2 ring-red-500 rounded-lg @enderror">
                        @error('content')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-4">
                        <a href="{{ route('posts.index') }}" class="bg-slate-200 text-slate-800 font-semibold px-5 py-2 rounded-lg ...">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg ...">Buat Pertanyaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
