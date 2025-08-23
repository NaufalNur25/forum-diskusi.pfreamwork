<header class="bg-white shadow-sm">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <img src="{{ asset('images/logo-non-bg.png') }}" alt="Logo NerdU" class="w-16 h-16">
            </div>
            <div class="hidden md:flex items-center justify-center gap-5 relative">
                @auth
                    <div class="relative">
                        <button
                            id="profile-menu-button"
                            class="flex items-center py-2 px-4 rounded-xl shadow-sm font-semibold text-gray-800 hover:bg-blue-50 focus:outline-none hover:cursor-pointer"
                        >
                            <img src="{{ Auth::user()->profile_photo_url ?? 'https://picsum.photos/50/50' }}"
                                alt="Profile"
                                class="w-8 h-8 rounded-full mr-2">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ml-2 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="profile-menu"
                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
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

        btn.addEventListener("click", function (e) {
            e.stopPropagation();
            menu.classList.toggle("hidden");
        });

        document.addEventListener("click", function (e) {
            if (!btn.contains(e.target)) {
                menu.classList.add("hidden");
            }
        });
    });
</script>
