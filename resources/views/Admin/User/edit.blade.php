@extends('Layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb --}}
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600"
                    >
                        <x-gmdi-home class="w-4 h-4 mr-1" />
                        Dashboard
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('admin.user') }}"
                        class="flex items-center"
                    >
                        <x-gmdi-arrow-forward-ios-r
                            class="w-4 h-4 text-gray-400"
                        />
                        <span
                            class="ml-1 text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-2"
                        >
                            Users
                        </span>
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <x-gmdi-arrow-forward-ios-r
                            class="w-4 h-4 text-gray-400"
                        />
                        <span
                            class="ml-1 text-sm font-medium text-gray-500 md:ml-2"
                        >
                            Edit User
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit User</h1>
            <p class="text-gray-600 mt-2">
                Update user profile and information for {{ $user->name }}
            </p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">
                    User Information
                </h2>
            </div>

            <form
                action="{{ route('admin.user.update', $user) }}"
                method="POST"
                enctype="multipart/form-data"
                class="p-6"
            >
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Full Name --}}
                    <div>
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Full Name
                            <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                            required
                        />
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Email Address --}}
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Email Address
                            <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror disabled:bg-gray-300"
                            required
                            disabled
                        />
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Biograph --}}
                    <div class="md:col-span-2">
                        <label
                            for="biograph"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Biograph
                        </label>
                        <textarea
                            id="biograph"
                            name="biograph"
                            rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('biograph') border-red-500 @enderror"
                        >
{{ old('biograph', $user->biograph) }}</textarea
                        >
                        @error('biograph')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="md:col-span-2">
                        <label
                            for="description"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Description
                        </label>
                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                        >
{{ old('description', $user->description) }}</textarea
                        >
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Change Password --}}
                    <div class="md:col-span-2 pt-4 border-t border-gray-200">
                        <p class="text-sm font-medium text-gray-700 mb-2">
                            Change Password (Optional)
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    for="password"
                                    class="block text-sm text-gray-600 mb-2"
                                >
                                    New Password
                                </label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                                />
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label
                                    for="password_confirmation"
                                    class="block text-sm text-gray-600 mb-2"
                                >
                                    Confirm New Password
                                </label>
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                />
                            </div>
                        </div>
                    </div>

                    {{-- Photo --}}
                    <div class="md:col-span-2">
                        <label
                            for="photo"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Photo
                        </label>
                        <div class="flex items-center space-x-4">
                            @if ($user->photo)
                                <img
                                    src="{{ asset('storage/' . $user->photo) }}"
                                    alt="Profile Photo"
                                    class="w-20 h-20 rounded-full object-cover border border-gray-200 shadow-sm"
                                />
                            @else
                                <img
                                    src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default-profile.png') }}"
                                    alt="Profile Photo"
                                    class="w-20 h-20 rounded-full object-cover border border-gray-200 shadow-sm"
                                />
                            @endif
                            <input
                                type="file"
                                id="photo"
                                name="photo"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('avatar') border-red-500 @enderror"
                            />
                        </div>
                        @error('photo')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Form Actions --}}
                <div
                    class="flex items-center justify-between pt-6 mt-6 border-t border-gray-200"
                >
                    <div class="text-sm text-gray-500">
                        <span class="inline-flex items-center">
                            <x-gmdi-info-o class="w-4 h-4 mr-1" />
                            Fields with
                            <span class="text-red-500 font-medium ml-1">*</span>
                            are required
                        </span>
                    </div>

                    <div class="flex items-center space-x-3">
                        <a
                            href="{{ route('admin.user.show', $user) }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-colors"
                        >
                            <x-gmdi-clear class="w-4 h-4 mr-2" />
                            Cancel
                        </a>
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors"
                        >
                            <x-gmdi-save class="w-4 h-4 mr-2" />
                            Update User
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
