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
                    <div class="flex items-center cursor-default">
                        <x-gmdi-arrow-forward-ios-r
                            class="w-4 h-4 text-gray-400"
                        />
                        <span
                            class="ml-1 text-sm font-medium text-gray-500 md:ml-2"
                        >
                            Master Category
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Master Category
                </h1>
                <p class="text-gray-600 mt-2">Category Overview</p>
            </div>
            <a
                href="{{ route('admin.master.category.create') }}"
                class="inline-flex h-fit mt-auto items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                <x-gmdi-add class="w-5 h-5 mr-2" />
                Add new Category
            </a>
        </div>

        <div class="mb-6">
            <form
                method="GET"
                action="{{ route('admin.master.category') }}"
                class="flex flex-col sm:flex-row gap-4"
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
                            placeholder="Search categories by name..."
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm"
                        />
                    </div>
                </div>
                <div class="flex gap-2">
                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        <x-gmdi-search class="w-4 h-4 mr-2" />
                        Search
                    </button>
                    @if (request('search'))
                        <a
                            href="{{ route('admin.master.category') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                        >
                            <x-gmdi-clear class="w-4 h-4 mr-2" />
                            Clear
                        </a>
                    @endif
                </div>
            </form>

            @if (request('search'))
                <div class="mt-3">
                    <p class="text-sm text-gray-600">
                        Search results for:
                        <span class="font-semibold text-gray-900">
                            "{{ request('search') }}"
                        </span>

                        @if ($categories->total() > 0)
                            - {{ $categories->total() }}
                            {{ Str::plural('result', $categories->total()) }}
                            found
                        @else
                                - No results found
                        @endif
                    </p>
                </div>
            @endif
        </div>

        <div
            class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden"
        >
            <table class="w-full">
                <thead class="bg-blue-500">
                    <tr>
                        <th
                            class="px-6 py-4 text-left text-sm font-medium text-white uppercase tracking-wider w-16"
                        >
                            No
                        </th>
                        <th
                            class="px-6 py-4 text-left text-sm font-medium text-white uppercase tracking-wider"
                        >
                            Name
                        </th>
                        <th
                            class="px-6 py-4 text-center text-sm font-medium text-white uppercase tracking-wider w-32"
                        >
                            Related Posts
                        </th>
                        <th
                            class="px-6 py-4 text-center text-sm font-medium text-white uppercase tracking-wider w-32"
                        >
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($categories ?? [] as $index => $category)
                        <tr
                            class="{{ $loop->even ? 'bg-blue-50' : 'bg-white' }} hover:{{ $loop->even ? 'bg-blue-100' : 'bg-gray-50' }} transition-colors duration-200"
                        >
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                            >
                                {{ $categories->firstItem() + $index }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                            >
                                @if (request('search'))
                                    {!! str_ireplace(request('search'), '<mark class="bg-yellow-200 px-1 rounded">' . request('search') . '</mark>', e($category->name)) !!}
                                @else
                                    {{ $category->name }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800"
                                >
                                    {{ $category->posts_count ?? 0 }} Posts
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div
                                    class="flex items-center justify-center space-x-2"
                                >
                                    <a
                                        href="{{ route('admin.master.category.edit', $category) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2"
                                        title="Edit Category"
                                    >
                                        <x-gmdi-edit-note-o class="w-6 h-6" />
                                    </a>

                                    <form
                                        action="{{ route('admin.master.category.destroy', $category) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this category?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                            title="Delete Category"
                                        >
                                            <x-gmdi-delete-o class="w-5 h-5" />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div
                                    class="flex flex-col items-center justify-center"
                                >
                                    @if (request('search'))
                                        <x-gmdi-search
                                            class="w-16 h-16 text-gray-400 mb-4"
                                        />
                                        <h3
                                            class="text-lg font-medium text-gray-900 mb-2"
                                        >
                                            No Search Results
                                        </h3>
                                        <p class="text-gray-500 text-sm mb-4">
                                            No categories found matching "
                                            <strong>
                                                {{ request('search') }}
                                            </strong>
                                            ". Try searching with different
                                            keywords.
                                        </p>
                                        <div class="flex gap-2">
                                            <a
                                                href="{{ route('admin.master.category') }}"
                                                class="inline-flex items-center px-3 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-md transition-colors duration-200"
                                            >
                                                Clear Search
                                            </a>
                                            <a
                                                href="{{ route('admin.master.category.create') }}"
                                                class="inline-flex items-center px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition-colors duration-200"
                                            >
                                                <x-gmdi-add
                                                    class="w-5 h-5 mr-2"
                                                />
                                                Add new category
                                            </a>
                                        </div>
                                    @else
                                        <x-gmdi-search
                                            class="w-16 h-16 text-gray-400 mb-4"
                                        />
                                        <h3
                                            class="text-lg font-medium text-gray-900 mb-2"
                                        >
                                            No Record Found
                                        </h3>
                                        <p class="text-gray-500 text-sm mb-4">
                                            There are no categories available
                                            yet. Start by adding a new category.
                                        </p>
                                        <a
                                            href="{{ route('admin.master.category.create') }}"
                                            class="inline-flex items-center px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition-colors duration-200"
                                        >
                                            <x-gmdi-add class="w-5 h-5 mr-2" />
                                            Add new category
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-between items-center">
            <div class="text-sm text-gray-700">
                @if ($categories->total() > 0)
                    Showing {{ $categories->firstItem() }} -
                    {{ $categories->lastItem() }} from
                    {{ $categories->total() }} categories
                    @if (request('search'))
                        (filtered from total categories)
                    @endif
                @else
                    @if (request('search'))
                        No categories found for "{{ request('search') }}"
                    @else
                            No category data
                    @endif
                @endif
            </div>
            <div>
                {{ $categories->appends(request()->query())->links('templates.custom-pagination') }}
            </div>
        </div>
    </div>
@endsection
