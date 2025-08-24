@extends('Layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 pt-10 pb-6">
    <div class="flex items-start justify-between">
        <div class="flex space-x-6 gap-8">
            <img
                src="{{ $user->photo ? asset('storage/'.$user->photo) : asset('images/default-profile.png') }}"
                alt="Profile Photo"
                class="w-28 h-28 rounded-full mx-auto object-cover shadow-md"
            >
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                <p class="text-gray-600 mb-4">{{ $user->email }}</p>
                <p class="text-gray-700 font-semibold">
                    {{ $user->biograph ?? 'Belum ada bio.' }}
                </p>

                <p class="text-gray-700">
                    {{ $user->description ?? 'Belum ada deskripsi.' }}
                </p>
            </div>
        </div>
        <div>
            <a href="/profile/settings"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
                Edit Profile
            </a>
        </div>
    </div>

    <div class="space-y-6 mt-10">
        <h2 class="text-xl font-semibold text-slate-800">Postingan Saya</h2>
        @forelse($posts as $post)
            <x-post-card :post="$post" />
        @empty
            <p class="text-slate-500 w-full text-center">Belum ada postingan.</p>
        @endforelse
    </div>
</div>
@endsection
