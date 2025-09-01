@extends('Layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
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
                    <div class="flex items-center cursor-default">
                        <x-gmdi-arrow-forward-ios-r
                            class="w-4 h-4 text-gray-400"
                        />
                        <span
                            class="ml-1 text-sm font-medium text-gray-500 md:ml-2"
                        >
                            Users
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        <div
            class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between"
        >
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Users</h1>
                <p class="text-gray-600 mt-2">
                    Manage system users and their roles
                </p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a
                    href="{{ route('admin.user.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-sm"
                >
                    <x-gmdi-add class="w-5 h-5 mr-2" />
                    Add New User
                </a>
            </div>
        </div>

        <div class="mb-6">
            <form
                method="GET"
                action="{{ route('admin.user') }}"
                class="flex flex-col lg:flex-row gap-4"
            >
                <div class="flex-1">
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                        >
                            <x-gmdi-search class="h-5 w-5 text-gray-400" />
                        </div>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search users by name or email..."
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm"
                        />
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-2">
                    <select
                        name="status"
                        class="px-3 py-2 border border-gray-300 rounded-lg bg-white text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="">All Status</option>
                        <option
                            value="safe"
                            {{ request('status') === 'safe' ? 'selected' : '' }}
                        >
                            Safe
                        </option>
                        <option
                            value="banned"
                            {{ request('status') === 'banned' ? 'selected' : '' }}
                        >
                            Banned
                        </option>
                    </select>
                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        <x-gmdi-search class="w-4 h-4 mr-2" />
                        Search
                    </button>
                    @if (request()->hasAny(['search', 'role', 'status']))
                        <a
                            href="{{ route('admin.user') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                        >
                            <x-gmdi-clear class="w-4 h-4 mr-2" />
                            Clear
                        </a>
                    @endif
                </div>
            </form>

            @if (request('search') || request('role') || request('status'))
                <div class="mt-3">
                    <p class="text-sm text-gray-600">
                        @if (request('search'))
                            Search results for:
                            <span class="font-semibold text-gray-900">
                                "{{ request('search') }}"
                            </span>
                        @endif

                        @if (request('role'))
                            @if (request('search'))
                                |
                            @endif

                            Role:
                            <span class="font-semibold text-gray-900">
                                {{ ucfirst(request('role')) }}
                            </span>
                        @endif

                        @if (request('status'))
                            @if (request('search') || request('role'))
                                |
                            @endif

                            Status:
                            <span class="font-semibold text-gray-900">
                                {{ ucfirst(request('status')) }}
                            </span>
                        @endif

                        @if ($users->total() > 0)
                            - {{ $users->total() }}
                            {{ Str::plural('result', $users->total()) }} found
                        @else
                                - No results found
                        @endif
                    </p>
                </div>
            @endif
        </div>

        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-700">View:</span>
                <div class="inline-flex rounded-lg border border-gray-200">
                    <button
                        class="px-3 py-1 text-sm font-medium text-blue-600 bg-blue-50 rounded-l-lg border-r border-gray-200 focus:outline-none"
                    >
                        <x-gmdi-grid-view class="w-4 h-4" />
                    </button>
                    <a
                        href="#"
                        class="px-3 py-1 text-sm font-medium text-gray-500 hover:text-gray-700 bg-white rounded-r-lg focus:outline-none"
                    >
                        <x-gmdi-view-list class="w-4 h-4" />
                    </a>
                </div>
            </div>
            <div class="text-sm text-gray-700">
                @if ($users->total() > 0)
                    Showing {{ $users->firstItem() }} -
                    {{ $users->lastItem() }} of {{ $users->total() }} users
                @else
                        No users found
                @endif
            </div>
        </div>

        @if ($users->count() > 0)
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
            >
                @foreach ($users as $user)
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-200 hover:-translate-y-1 flex flex-col"
                    >
                        <div class="relative p-6 pb-0">
                            <div class="w-20 h-20 mx-auto mb-4 relative">
                                @if ($user->photo)
                                    <img
                                        src="{{ asset('storage/' . $user->photo) }}"
                                        alt="{{ $user->name }}"
                                        class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-sm"
                                    />
                                @else
                                    <div
                                        class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center border-4 border-white shadow-sm"
                                    >
                                        <span
                                            class="text-white text-xl font-bold"
                                        >
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </span>
                                    </div>
                                @endif

                                <div class="absolute -bottom-1 -right-1">
                                    @if ($user->status)
                                        <span
                                            class="flex items-center justify-center w-6 h-6 bg-green-500 rounded-full border-2 border-white shadow-sm"
                                        >
                                            <x-gmdi-check
                                                class="w-3 h-3 text-white m-0.5"
                                            />
                                        </span>
                                    @else
                                        <span
                                            class="flex items-center justify-center w-6 h-6 bg-red-500 rounded-full border-2 border-white shadow-sm"
                                        >
                                            <x-gmdi-close
                                                class="w-3 h-3 text-white"
                                            />
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div
                            class="p-6 pt-2 text-center flex-grow flex flex-col"
                        >
                            <h3
                                class="text-lg font-semibold text-gray-900 mb-1 truncate"
                            >
                                {{ $user->name }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-2 truncate">
                                {{ $user->email }}
                            </p>

                            <div class="mb-4">
                                @php
                                    $roleColors = [
                                        'admin' => 'bg-red-100 text-red-800',
                                        'user' => 'bg-green-100 text-green-800',
                                    ];
                                    $roleColor = $roleColors[strtolower($user->role->name)] ?? 'bg-gray-100 text-gray-800';
                                @endphp

                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $roleColor }}"
                                >
                                    {{ ucfirst($user->role->name) }}
                                </span>
                            </div>

                            <!-- Stats section with fixed height -->
                            <div
                                class="mb-4 h-16 flex items-center justify-center"
                            >
                                @if (strtolower($user->role->name) === 'user')
                                    <div
                                        class="grid grid-cols-2 gap-4 text-center w-full"
                                    >
                                        <div>
                                            <div
                                                class="text-lg font-bold text-gray-900"
                                            >
                                                {{ $user->posts_count ?? 0 }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                Posts
                                            </div>
                                        </div>
                                        <div>
                                            <div
                                                class="text-lg font-bold text-gray-900"
                                            >
                                                {{ $user->created_at ? $user->created_at->diffForHumans() : 'N/A' }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                Days ago
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center w-full">
                                        <div
                                            class="text-lg font-bold text-gray-900"
                                        >
                                            {{ $user->created_at ? $user->created_at->diffForHumans() : 'N/A' }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            Days ago
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Actions - pushed to bottom with mt-auto -->
                            <div
                                class="flex items-center justify-center space-x-2 mt-auto"
                            >
                                <a
                                    href="{{ route('admin.user.show', $user) }}"
                                    class="inline-flex items-center justify-center w-8 h-8 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                    title="View User"
                                >
                                    <x-gmdi-visibility class="w-4 h-4" />
                                </a>
                                <a
                                    href="{{ route('admin.user.edit', $user) }}"
                                    class="inline-flex items-center justify-center w-8 h-8 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2"
                                    title="Edit User"
                                >
                                    <x-gmdi-edit-note-o class="w-4 h-4" />
                                </a>
                                @if ($user->id !== auth()->id())
                                    <form
                                        action="{{ route('admin.user.destroy', $user) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this user?')"
                                        class="inline"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                            title="Delete User"
                                        >
                                            <x-gmdi-delete-o class="w-4 h-4" />
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <!-- Footer Info -->
                        <div
                            class="px-6 py-3 bg-gray-50 border-t border-gray-100 mt-auto"
                        >
                            <div
                                class="flex items-center justify-between text-xs text-gray-500"
                            >
                                <span class="flex items-center">
                                    <x-gmdi-schedule class="w-3 h-3 mr-1" />
                                    {{ $user->created_at ? $user->created_at->format('M j, Y') : '-' }}
                                </span>
                                <span class="flex items-center">
                                    <x-gmdi-update class="w-3 h-3 mr-1" />
                                    {{ $user->updated_at ? $user->updated_at->diffForHumans() : '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="flex flex-col items-center justify-center">
                    @if (request()->hasAny(['search', 'role', 'status']))
                        <x-gmdi-search class="w-16 h-16 text-gray-400 mb-4" />
                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            No Search Results
                        </h3>
                        <p class="text-gray-500 text-sm mb-4 max-w-md">
                            No users found matching your search criteria. Try
                            adjusting your filters or search terms.
                        </p>
                        <div class="flex gap-2">
                            <a
                                href="{{ route('admin.user') }}"
                                class="inline-flex items-center px-3 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition-colors duration-200"
                            >
                                Clear Filters
                            </a>
                            <a
                                href="{{ route('admin.user.create') }}"
                                class="inline-flex items-center px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-colors duration-200"
                            >
                                <x-gmdi-add class="w-4 h-4 mr-2" />
                                Add New User
                            </a>
                        </div>
                    @else
                        <x-gmdi-group class="w-16 h-16 text-gray-400 mb-4" />
                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            No Users Found
                        </h3>
                        <p class="text-gray-500 text-sm mb-4">
                            There are no users in the system yet. Start by
                            adding a new user.
                        </p>
                        <a
                            href="{{ route('admin.user.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-colors duration-200"
                        >
                            <x-gmdi-add class="w-5 h-5 mr-2" />
                            Add New User
                        </a>
                    @endif
                </div>
            </div>
        @endif

        <!-- Pagination -->
        @if ($users->hasPages())
            <div class="mt-8 flex justify-between items-center">
                <div class="text-sm text-gray-700">
                    @if ($users->total() > 0)
                        Showing {{ $users->firstItem() }} -
                        {{ $users->lastItem() }} of {{ $users->total() }}
                        users
                        @if (request()->hasAny(['search', 'role', 'status']))
                            (filtered results)
                        @endif
                    @endif
                </div>
                <div>
                    {{ $users->appends(request()->query())->links('templates.custom-pagination') }}
                </div>
            </div>
        @endif
    </div>

    <!-- Success/Error Messages -->
    @if (session('success'))
        <div
            id="success-message"
            class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg z-50"
        >
            <div class="flex items-center">
                <x-gmdi-check-circle class="w-4 h-4 mr-2" />
                {{ session('success') }}
            </div>
        </div>
    @endif

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
        // Auto-hide messages after 5 seconds
        setTimeout(function () {
            const successMessage = document.getElementById('success-message')
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
