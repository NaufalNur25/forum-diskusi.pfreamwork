<header class="bg-white shadow-sm">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center gap-6 flex-1">
                <img src="{{ asset('images/logo-non-bg.png') }}" alt="Logo NerdU" class="w-16 h-16">
                <form action="{{ route('posts.index') }}" method="GET" class="hidden md:block w-full max-w-sm">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            placeholder="Cari..."
                            autocomplete="off"
                            value="{{ request('search') }}"
                            class="w-full border rounded-full py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700"
                        />
                        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103.5 3.5a7.5 7.5 0 0013.15 13.15z" />
                            </svg>
                        </div>
                    </div>
                </form>
            </div>

            <div class="hidden md:flex items-center justify-center gap-5 relative">
                @auth
                    @php
                        $profileImage = Auth::user()->photo ? asset('storage/'.Auth::user()->photo) :  asset('images/default-profile.png');
                    @endphp

                    <div class="relative">
                        <button
                            id="profile-menu-button"
                            class="flex items-center py-2 px-4 rounded-xl shadow-sm font-semibold text-gray-800 hover:bg-blue-50 focus:outline-none hover:cursor-pointer"
                        >
                            <img src="{{ $profileImage }}" alt="Profile"
                                class="w-8 h-8 rounded-full object-cover mr-2">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ml-2 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div id="profile-menu"
                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                            <a href="{{ route('Profile.view') }}"
                            class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50">
                                <img src="{{ $profileImage }}" alt="Profile"
                                    class="w-6 h-6 rounded-full object-cover mr-2">
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <a href="{{ route('Profile.edit') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-blue-50">
                                Settings
                            </a>
                            <form method="POST" action="{{ route('authentication.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-50 hover:cursor-pointer">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('authentication.login') }}"
                    class="flex items-center w-fit py-3 px-4 border border-transparent rounded-xl shadow-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]">
                        <x-gmdi-login class="w-5 h-5 mr-2"/>
                        Login
                    </a>
                @endauth
            </div>

            <div class="md:hidden">
                <button class="text-blue-500 hover:text-blue-700">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const btn = document.getElementById("profile-menu-button");
        const menu = document.getElementById("profile-menu");

        if (btn) {
            btn.addEventListener("click", function (e) {
                e.stopPropagation();
                menu.classList.toggle("hidden");
            });

            document.addEventListener("click", function (e) {
                if (!btn.contains(e.target)) {
                    menu.classList.add("hidden");
                }
            });
        }
    });
</script>
