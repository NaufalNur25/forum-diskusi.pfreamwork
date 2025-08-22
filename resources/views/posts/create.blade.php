@extends('Layouts.app')

@section('title', 'Buat Pertanyaan Baru')

@section('content')
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 sm:p-8">
                <h1 class="text-2xl font-bold text-slate-800 mb-6">Buat Pertanyaan Baru</h1>

                {{-- Form untuk membuat pertanyaan baru --}}
                <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label for="question" class="block text-sm font-medium text-slate-700">Pertanyaan</label>
                        <input type="text" name="question" id="question" value="{{ old('question') }}" required
                               class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm {{ $errors->has('question') ? 'border-red-500' : 'border-slate-300' }}">
                        @error('question')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-slate-700">Kategori</label>
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
                        <a href="{{ route('posts.index') }}" class="bg-slate-200 text-slate-800 font-semibold px-5 py-2 rounded-lg shadow-sm hover:bg-slate-300 transition-colors">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg shadow-sm hover:bg-blue-700 transition-colors">Buat Pertanyaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
