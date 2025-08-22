@extends('Layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-slate-800">Daftar Pertanyaan</h1>
            <a href="{{ route('posts.create') }}"
            class="bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-200 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd"/>
                </svg>
                <span>Buat Pertanyaan</span>
            </a>
        </div>

        <div class="bg-white p-4 rounded-xl shadow-sm mb-6">
            <form action="{{ route('posts.index') }}" method="GET"
                class="flex flex-col sm:flex-row items-center gap-4">

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
                <x-post-card :post="$post" />
            @empty
                <div class="col-span-full text-center ...">
                    Tidak ada pertanyaan.
                </div>
            @endforelse
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $posts->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
