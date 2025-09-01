@extends('Layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
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
                        href="{{ route('admin.master.role') }}"
                        class="flex items-center"
                    >
                        <x-gmdi-arrow-forward-ios-r
                            class="w-4 h-4 text-gray-400"
                        />
                        <span
                            class="ml-1 text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-2"
                        >
                            Master Role
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
                            Edit Role
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Role</h1>
            <p class="text-gray-600 mt-2">Update role information</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">
                    Role Information
                </h2>
            </div>

            <form
                action="{{ route('admin.master.role.update', $role) }}"
                method="POST"
                class="p-6"
            >
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Role Name
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $role->name) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('name') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    />

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">
                            <x-gmdi-info class="inline w-4 h-4 mr-1" />
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div
                    class="flex items-center justify-between pt-6 border-t border-gray-200"
                >
                    <div class="text-sm text-gray-500">
                        <span class="inline-flex items-center">
                            <x-gmdi-info-o class="w-4 h-4 mr-1" />
                            Field with mark
                            <span class="text-red-500 font-medium ml-1">*</span>
                            required fields
                        </span>
                    </div>

                    <div class="flex items-center space-x-3">
                        <a
                            href="{{ route('admin.master.role') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200"
                        >
                            <x-gmdi-clear class="w-4 h-4 mr-2" />
                            Cancle
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
                        >
                            <x-gmdi-check class="w-4 h-4 mr-2" />
                            Update Role
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <x-gmdi-info class="w-5 h-5 text-blue-400 mt-0.5 mr-3" />
                <div>
                    <h3 class="text-sm font-medium text-blue-800">
                        Role Information
                    </h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>
                                Role:
                                <strong>{{ $role->name }}</strong>
                            </li>
                            <li>
                                Created At:
                                <strong>
                                    {{ $role->created_at ? $role->created_at->format('d M Y, H:i') : '-' }}
                                </strong>
                            </li>
                            <li>
                                Last Updated:
                                <strong>
                                    {{ $role->updated_at ? $role->updated_at->format('d M Y, H:i') : '-' }}
                                </strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('error'))
        <div
            id="error-message"
            class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg z-50"
        >
            <div class="flex items-center">
                <x-gmdi-cancel-r class="w-4 h-4 mr-2" />
                {{ session('error') }}
            </div>
        </div>
    @endif

    <script>
        setTimeout(function () {
            const errorMessage = document.getElementById('error-message')

            if (successMessage) {
                successMessage.style.opacity = '0'
                successMessage.style.transition = 'opacity 0.5s'
                setTimeout(() => successMessage.remove(), 500)
            }

            if (errorMessage) {
                errorMessage.style.opacity = '0'
                errorMessage.style.transition = 'opacity 0.5s'
                setTimeout(() => errorMessage.remove(), 500)
            }
        }, 5000)
    </script>
@endsection
