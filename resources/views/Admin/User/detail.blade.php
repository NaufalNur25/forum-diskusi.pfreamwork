@extends('Layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
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
                            {{ $user->name }}
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section with Actions -->
        <div class="mb-8">
            <div
                class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4"
            >
                <div class="flex items-start space-x-4">
                    <!-- User Avatar -->
                    <div class="flex-shrink-0">
                        @if ($user->avatar)
                            <img
                                src="{{ asset('storage/' . $user->avatar) }}"
                                alt="{{ $user->name }}"
                                class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-lg"
                            />
                        @else
                            <div
                                class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center border-4 border-white shadow-lg"
                            >
                                <span class="text-white text-2xl font-bold">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- User Info -->
                    <div>
                        <div class="flex items-center gap-3">
                            <h1 class="text-3xl font-bold text-gray-900">
                                {{ $user->name }}
                            </h1>
                            @if ($user->status == App\Models\User::$statusTexts['safe'])
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800"
                                >
                                    <x-gmdi-check-circle class="w-3 h-3 mr-1" />
                                    Safe
                                </span>
                            @elseif ($user->status == App\Models\User::$statusTexts['unverified'])
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"
                                >
                                    <x-gmdi-warning class="w-3 h-3 mr-1" />
                                    Unverified
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800"
                                >
                                    <x-gmdi-cancel class="w-3 h-3 mr-1" />
                                    Banned
                                </span>
                            @endif
                        </div>
                        <p class="text-gray-600 mt-1">{{ $user->email }}</p>

                        <!-- Role Badge -->
                        <div class="mt-2">
                            @php
                                $roleColors = [
                                    'admin' => 'bg-red-100 text-red-800',
                                    'user' => 'bg-green-100 text-green-800',
                                ];
                                $roleColor = $roleColors[strtolower($user->role->name)] ?? 'bg-gray-100 text-gray-800';
                            @endphp

                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium {{ $roleColor }}"
                            >
                                <x-gmdi-person class="w-3 h-3 mr-1" />
                                {{ ucfirst($user->role->name) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-3">
                    <a
                        href="{{ route('admin.user.edit', $user) }}"
                        class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2"
                    >
                        <x-gmdi-edit-note-o class="w-4 h-4 mr-2" />
                        Edit User
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
                                class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                            >
                                <x-gmdi-delete-o class="w-4 h-4 mr-2" />
                                Delete User
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Main Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200"
                >
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2
                            class="text-lg font-semibold text-gray-900 flex items-center"
                        >
                            <x-gmdi-info class="w-5 h-5 mr-2 text-blue-500" />
                            Basic Information
                        </h2>
                    </div>
                    <div class="p-6">
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">
                                    Full Name
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $user->name ?? '-' }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">
                                    Email Address
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $user->email ?? '-' }}
                                </dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">
                                    Biograph
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $user->biograph ?? 'No bio available' }}
                                </dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">
                                    Description
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $user->description ?? 'No description provided' }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Recent Posts -->
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200"
                >
                    <div
                        class="px-6 py-4 border-b border-gray-200 flex items-center justify-between"
                    >
                        <h2
                            class="text-lg font-semibold text-gray-900 flex items-center"
                        >
                            <x-gmdi-article
                                class="w-5 h-5 mr-2 text-blue-500"
                            />
                            Recent Posts ({{ $user->posts->count() }})
                        </h2>
                        @if ($user->posts->count() > 0)
                            <a
                                href="#"
                                class="text-sm text-blue-600 hover:text-blue-800"
                            >
                                View All
                            </a>
                        @endif
                    </div>
                    <div class="p-6">
                        @if ($user->posts->count() > 0)
                            <div class="space-y-4">
                                @foreach ($user->posts->take(5) as $post)
                                    <div
                                        class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-150"
                                    >
                                        @if ($post->content)
                                            <img
                                                src="{{ asset('storage/' . $post->content) }}"
                                                alt="{{ $post->title }}"
                                                class="w-12 h-12 rounded-lg object-cover"
                                            />
                                        @else
                                            <div
                                                class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center"
                                            >
                                                <x-gmdi-image
                                                    class="w-6 h-6 text-gray-400"
                                                />
                                            </div>
                                        @endif
                                        <div class="flex-1 min-w-0">
                                            <p
                                                class="text-sm font-medium text-gray-900 truncate"
                                            >
                                                {{ $post->question }}
                                            </p>
                                            <p
                                                class="text-xs text-gray-500 mt-1"
                                            >
                                                {{ $post->created_at->format('M j, Y') }}
                                                •
                                                <span
                                                    class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800"
                                                >
                                                    {{ $post->category->name }}
                                                </span>
                                            </p>
                                        </div>
                                        <a
                                            href="{{ route('admin.user.post.show', $post) }}"
                                            class="text-blue-600 hover:text-blue-800"
                                        >
                                            <x-gmdi-arrow-forward
                                                class="w-4 h-4"
                                            />
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <x-gmdi-article
                                    class="w-12 h-12 text-gray-400 mx-auto mb-3"
                                />
                                <p class="text-sm text-gray-500">
                                    No posts created yet
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action -->
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200"
                >
                    <div
                        class="px-6 py-4 border-b border-gray-200 flex items-center justify-between"
                    >
                        <h2
                            class="text-lg font-semibold text-gray-900 flex items-center"
                        >
                            <x-gmdi-manage-accounts-r
                                class="w-5 h-5 mr-2 text-blue-500"
                            />
                            Admin Tools
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div
                                class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors"
                            >
                                <div class="flex items-center space-x-3">
                                    @if (! $user->is_blocked)
                                        <div
                                            class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center"
                                        >
                                            <x-gmdi-block
                                                class="w-5 h-5 text-red-600"
                                            />
                                        </div>
                                        <div>
                                            <h3
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                Ban User
                                            </h3>
                                            <p class="text-xs text-gray-500">
                                                Restrict user access
                                            </p>
                                        </div>
                                    @else
                                        <div
                                            class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center"
                                        >
                                            <x-gmdi-check-circle
                                                class="w-5 h-5 text-green-600"
                                            />
                                        </div>
                                        <div>
                                            <h3
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                Unban User
                                            </h3>
                                            <p class="text-xs text-gray-500">
                                                Restore user access
                                            </p>
                                        </div>
                                    @endif
                                </div>
                                @if ($user->id !== auth()->id())
                                    <form
                                        action="{{ route('admin.user.banned', $user) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to {{ ! $user->is_blocked ? 'ban' : 'unban' }} this user?')"
                                        class="inline"
                                    >
                                        @csrf
                                        @method('PATCH')
                                        @if (! $user->is_blocked)
                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center min-w-[100px] px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                            >
                                                <x-gmdi-block
                                                    class="w-4 h-4 mr-1"
                                                />
                                                Ban
                                            </button>
                                        @else
                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center min-w-[100px] px-3 py-2 bg-green-500 hover:bg-green-600 text-white text-xs font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                                            >
                                                <x-gmdi-check-circle
                                                    class="w-4 h-4 mr-1"
                                                />
                                                Unban
                                            </button>
                                        @endif
                                    </form>
                                @else
                                    <span class="text-xs text-gray-400 italic">
                                        Cannot modify own account
                                    </span>
                                @endif
                            </div>

                            <!-- Send Password Reset Email -->
                            <div
                                class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors"
                            >
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center"
                                    >
                                        <x-gmdi-mail
                                            class="w-5 h-5 text-blue-600"
                                        />
                                    </div>
                                    <div>
                                        <h3
                                            class="text-sm font-medium text-gray-900"
                                        >
                                            Reset Password
                                        </h3>
                                        <p class="text-xs text-gray-500">
                                            Send password reset email
                                        </p>
                                    </div>
                                </div>
                                <form
                                    action="{{ route('admin.user.forget-password', $user) }}"
                                    method="POST"
                                    onsubmit="return confirm('Send password reset email to {{ $user->email }}?')"
                                    class="inline"
                                >
                                    @csrf
                                    <button
                                        type="submit"
                                        class="inline-flex items-center justify-center min-w-[100px] px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                    >
                                        <x-gmdi-send class="w-4 h-4 mr-1" />
                                        Send
                                    </button>
                                </form>
                            </div>

                            <!-- Change Email -->
                            <div
                                class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors"
                            >
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center"
                                    >
                                        <x-gmdi-alternate-email
                                            class="w-5 h-5 text-yellow-600"
                                        />
                                    </div>
                                    <div>
                                        <h3
                                            class="text-sm font-medium text-gray-900"
                                        >
                                            Change Email
                                        </h3>
                                        <p class="text-xs text-gray-500">
                                            Update user email address
                                        </p>
                                    </div>
                                </div>
                                <button
                                    type="button"
                                    onclick="openChangeEmailModal()"
                                    class="inline-flex items-center justify-center min-w-[100px] px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2"
                                >
                                    <x-gmdi-edit class="w-4 h-4 mr-1" />
                                    Change
                                </button>
                            </div>

                            <!-- Email Verification -->
                            @if (! $user->email_verified_at)
                                <div
                                    class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors"
                                >
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center"
                                        >
                                            <x-gmdi-mark-email-read
                                                class="w-5 h-5 text-purple-600"
                                            />
                                        </div>
                                        <div>
                                            <h3
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                Verify Email
                                            </h3>
                                            <p class="text-xs text-gray-500">
                                                Send verification email
                                            </p>
                                        </div>
                                    </div>
                                    <form
                                        action="{{ route('admin.user.verified-email', $user) }}"
                                        method="POST"
                                        onsubmit="return confirm('Send email verification to {{ $user->email }}?')"
                                        class="inline"
                                    >
                                        @csrf
                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center min-w-[100px] px-3 py-2 bg-purple-500 hover:bg-purple-600 text-white text-xs font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                                        >
                                            <x-gmdi-verified
                                                class="w-4 h-4 mr-1"
                                            />
                                            Verify
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Stats & Info -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Quick Stats -->
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200"
                >
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2
                            class="text-lg font-semibold text-gray-900 flex items-center"
                        >
                            <x-gmdi-analytics
                                class="w-5 h-5 mr-2 text-blue-500"
                            />
                            Quick Stats
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <x-gmdi-article
                                        class="w-5 h-5 text-gray-400 mr-2"
                                    />
                                    <span class="text-sm text-gray-600">
                                        Total Posts
                                    </span>
                                </div>
                                <span
                                    class="text-lg font-semibold text-gray-900"
                                >
                                    {{ $user->posts->count() }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <x-gmdi-calendar-today
                                        class="w-5 h-5 text-gray-400 mr-2"
                                    />
                                    <span class="text-sm text-gray-600">
                                        Days Active
                                    </span>
                                </div>
                                <div class="text-lg font-bold text-gray-900">
                                    {{ $user->created_at ? $user->created_at->diffForHumans() : 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Details -->
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200"
                >
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2
                            class="text-lg font-semibold text-gray-900 flex items-center"
                        >
                            <x-gmdi-account-circle
                                class="w-5 h-5 mr-2 text-blue-500"
                            />
                            Account Details
                        </h2>
                    </div>
                    <div class="p-6">
                        <dl class="space-y-3">
                            <div>
                                <dt
                                    class="text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    User ID
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    #{{ $user->user_id }}
                                </dd>
                            </div>
                            <div>
                                <dt
                                    class="text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Email Verification
                                </dt>
                                <dd class="mt-1">
                                    @if ($user->email_verified_at)
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800"
                                        >
                                            <x-gmdi-verified
                                                class="w-3 h-3 mr-1"
                                            />
                                            Verified
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"
                                        >
                                            <x-gmdi-warning
                                                class="w-3 h-3 mr-1"
                                            />
                                            Unverified
                                        </span>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt
                                    class="text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Status
                                </dt>
                                <dd class="mt-1">
                                    @if (! $user->is_blocked)
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800"
                                        >
                                            <x-gmdi-verified
                                                class="w-3 h-3 mr-1"
                                            />
                                            Safe
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800"
                                        >
                                            <x-gmdi-warning
                                                class="w-3 h-3 mr-1"
                                            />
                                            Banned
                                        </span>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt
                                    class="text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Member Since
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $user->created_at->format('F j, Y') }}
                                </dd>
                            </div>
                            <div>
                                <dt
                                    class="text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Last Updated
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $user->updated_at->diffForHumans() }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div
        id="changeEmailModal"
        data-state="closed"
        class="fixed inset-0 bg-black/70 items-center justify-center z-50 data-[state=open]:flex data-[state=closed]:hidden"
    >
        <div
            class="bg-white rounded-xl shadow-2xl p-6 sm:p-8 w-full max-w-lg mx-4"
        >
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-slate-800">
                    Change Email Address
                </h2>
                <button
                    id="closeModalBtn"
                    class="text-slate-500 hover:text-slate-800"
                    onclick="closeModal()"
                >
                    &times;
                </button>
            </div>
            <form
                id="createPostForm"
                action="{{ route('admin.user.change-email', $user) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PATCH')
                <div class="space-y-4">
                    <div>
                        <label
                            for="current_email"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Current Email
                        </label>
                        <input
                            type="email"
                            id="current_email"
                            value="{{ $user->email }}"
                            disabled
                            class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md text-sm"
                        />
                    </div>

                    <div>
                        <label
                            for="new_email"
                            class="block text-sm font-medium text-gray-700"
                        >
                            New Email
                        </label>
                        <input
                            type="email"
                            id="new_email"
                            name="email"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm"
                            placeholder="Enter new email address"
                        />
                    </div>

                    <div class="flex items-center space-x-3 pt-4">
                        <button
                            type="submit"
                            class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        >
                            <x-gmdi-save class="w-4 h-4 mr-2" />
                            Update Email
                        </button>
                        <button
                            type="button"
                            onclick="closeModal()"
                            class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
        const changeEmailModal = document.getElementById('changeEmailModal')
        const closeModalBtn = document.getElementById('closeModalBtn')
        const cancelBtn = document.getElementById('cancelBtn')

        function openChangeEmailModal() {
            changeEmailModal.dataset.state = 'open'
        }

        function closeModal() {
            changeEmailModal.dataset.state = 'closed'
        }

        document
            .getElementById('changeEmailModal')
            .addEventListener('click', function (e) {
                if (e.target === this) {
                    closeChangeEmailModal()
                }
            })

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
