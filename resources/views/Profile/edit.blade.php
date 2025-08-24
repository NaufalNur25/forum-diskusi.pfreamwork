@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg p-8 mt-4">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Profile</h2>

    <form action="{{ route('Profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="flex items-center space-x-6">
            <img
                src="{{ $user->photo ? asset('storage/'.$user->photo) : asset('images/default-profile.png') }}"
                alt="Profile Photo"
                class="w-20 h-20 rounded-full object-cover border border-gray-200 shadow-sm"
            >
            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700">Change Photo</label>
                <input
                    type="file"
                    name="photo"
                    id="photo"
                    class="mt-2 text-sm text-gray-600 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border file:border-gray-300 file:text-sm file:bg-gray-50 hover:file:bg-gray-100"
                >
            </div>
        </div>
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $user->name) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
        </div>
        <div>
            <label for="biograph" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
            <input
                type="text"
                name="biograph"
                id="biograph"
                value="{{ old('biograph', $user->biograph) }}"
                placeholder="Tulis bio singkatmu"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea
                name="description"
                id="description"
                rows="4"
                placeholder="Tuliskan sesuatu tentang dirimu"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >{{ old('description', $user->description) }}</textarea>
        </div>
        <div class="flex justify-end">
            <button
                type="submit"
                class="px-5 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
