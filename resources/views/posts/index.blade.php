@extends('Layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-slate-800">Questions</h1>
            @auth
                <button id="openCreateModalBtn"
                    class="bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-200 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Create New Post</span>
                </button>
            @endauth
            @guest
                <a href="{{ route('authentication.login') }}"
                    class="bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-200 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Login to Post</span>
                </a>
            @endguest
        </div>

        <div class="bg-white p-4 rounded-xl shadow-sm mb-6">
            <form action="{{ route('posts.index') }}" method="GET">
                <div class="flex items-center gap-x-4">

                    <select name="category" onchange="this.form.submit()"
                        class="w-full sm:w-56 px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}"
                                {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="sort" onchange="this.form.submit()"
                        class="w-full sm:w-56 px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="latest" @selected(request('sort', 'latest') == 'latest')>Sort by: Latest</option>
                        <option value="oldest" @selected(request('sort') == 'oldest')>Sort by: Oldest</option>
                        <option value="most_liked" @selected(request('sort') == 'most_liked')>Sort by: Most Liked</option>
                        <option value="most_commented" @selected(request('sort') == 'most_commented')>Sort by: Most Commented
                        </option>
                    </select>

                    <a href="{{ route('posts.index') }}"
                        class="text-slate-600 font-semibold px-4 py-2 rounded-lg hover:bg-slate-100 transition-colors whitespace-nowrap">
                        Reset
                    </a>

                </div>
            </form>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6" role="alert">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="space-y-4">
            @forelse ($posts as $post)
                <x-post-card :post="$post" />
            @empty
                <div class="bg-white text-center p-12 rounded-xl shadow-sm">
                    <p class="text-slate-500">No questions found.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $posts->appends(request()->query())->links() }}
        </div>
    </div>

    <div id="createModal" data-state="closed"
        class="fixed inset-0 bg-black/70 items-center justify-center z-50 data-[state=open]:flex data-[state=closed]:hidden">
        <div class="bg-white rounded-xl shadow-2xl p-6 sm:p-8 w-full max-w-lg mx-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-slate-800">Create New Question</h2>
                <button id="closeModalBtn" class="text-slate-500 hover:text-slate-800">&times;</button>
            </div>
            <form id="createPostForm" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="question" class="block text-sm font-medium text-slate-700 mb-1">Your Question</label>
                        <textarea id="question" name="question" placeholder="Write your question here..."
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        <div id="question-error" class="text-red-500 text-sm mt-1"></div>
                    </div>
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-slate-700 mb-1">Category</label>
                        <select id="category_id" name="category_id"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" disabled selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div id="category_id-error" class="text-red-500 text-sm mt-1"></div>
                    </div>
                    <div>
                        <label for="content" class="block text-sm font-medium text-slate-700 mb-1">Image (Optional)</label>
                        <input type="file" id="content" name="content" accept="image/*"
                            class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <div id="content-error" class="text-red-500 text-sm mt-1"></div>
                    </div>
                </div>
                <div class="mt-8 flex justify-end space-x-3">
                    <button type="button" id="cancelBtn"
                        class="bg-slate-100 text-slate-700 font-semibold px-5 py-2 rounded-lg hover:bg-slate-200">
                        Cancel
                    </button>
                    <button type="submit" id="submitBtn"
                        class="bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg hover:bg-blue-700 flex items-center">
                        <span id="submitBtnText">Submit Question</span>
                        <span id="submitBtnSpinner" class="hidden">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openModalBtn = document.getElementById('openCreateModalBtn');
            const createModal = document.getElementById('createModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            const createPostForm = document.getElementById('createPostForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitBtnText = document.getElementById('submitBtnText');
            const submitBtnSpinner = document.getElementById('submitBtnSpinner');

            function openModal() {
                createModal.dataset.state = 'open';
            }

            function closeModal() {
                createModal.dataset.state = 'closed';
                createPostForm.reset();
                clearErrors();
            }

            function clearErrors() {
                document.getElementById('question-error').textContent = '';
                document.getElementById('category_id-error').textContent = '';
                document.getElementById('content-error').textContent = '';
            }

            openModalBtn.addEventListener('click', openModal);
            closeModalBtn.addEventListener('click', closeModal);
            cancelBtn.addEventListener('click', closeModal);
            createModal.addEventListener('click', function(event) {
                if (event.target === createModal) {
                    closeModal();
                }
            });

            createPostForm.addEventListener('submit', async function(event) {
                event.preventDefault();
                submitBtn.disabled = true;
                submitBtnText.classList.add('hidden');
                submitBtnSpinner.classList.remove('hidden');
                clearErrors();

                const formData = new FormData(createPostForm);

                try {
                    const response = await fetch('{{ route('posts.store') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Accept': 'application/json',
                        }
                    });

                    if (response.ok) {
                        closeModal();
                        window.location.reload();
                    } else if (response.status === 422) {
                        const errors = await response.json();
                        if (errors.errors.question) {
                            document.getElementById('question-error').textContent = errors.errors
                                .question[0];
                        }
                        if (errors.errors.category_id) {
                            document.getElementById('category_id-error').textContent = errors.errors
                                .category_id[0];
                        }
                        if (errors.errors.content) {
                            document.getElementById('content-error').textContent = errors.errors
                                .content[0];
                        }
                    } else {
                        console.error('Server error:', response.status, await response.text());
                    }
                } catch (error) {
                    console.error('Request error:', error);
                } finally {
                    submitBtn.disabled = false;
                    submitBtnText.classList.remove('hidden');
                    submitBtnSpinner.classList.add('hidden');
                }
            });
        });
    </script>
@endsection
