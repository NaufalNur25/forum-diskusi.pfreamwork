<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Home - Website Sederhana</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-50 min-h-screen">
        <!-- Header/Navigation -->
        <header class="bg-white shadow-sm">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-blue-500">
                            MyWebsite
                        </h1>
                    </div>
                    <div
                        class="hidden md:flex items-center justify-center gap-5"
                    >
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a
                                href="#"
                                class="text-blue-500 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Home
                            </a>
                            <a
                                href="#"
                                class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium"
                            >
                                About
                            </a>
                            <a
                                href="#"
                                class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Services
                            </a>
                            <a
                                href="#"
                                class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Contact
                            </a>
                        </div>
                        @auth
                            <form
                                id="logout-form"
                                action="{{ route('authentication.logout') }}"
                                method="POST"
                            >
                                @csrf
                                <button
                                    class="flex items-center w-fit py-3 px-4 rounded-xl shadow-sm font-semibold text-gray-800 cursor-pointer hover:bg-blue-50"
                                    type="submit"
                                >
                                    <x-gmdi-person class="w-5 h-5 mr-2" />
                                    Hello, {{ Auth::user()->name }}
                                </button>
                            </form>
                        @else
                            <a
                                href="{{ route('authentication.login') }}"
                                class="flex items-center w-fit py-3 px-4 border border-transparent rounded-xl shadow-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]"
                            >
                                <x-gmdi-login class="w-5 h-5 mr-2" />
                                Login
                            </a>
                        @endauth
                    </div>
                    <div class="md:hidden">
                        <button class="text-blue-500 hover:text-blue-700">
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Hero Section -->
        <main>
            <section class="bg-gradient-to-b from-blue-50 to-white py-20">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2
                        class="text-4xl md:text-6xl font-bold text-gray-900 mb-6"
                    >
                        Selamat Datang di
                        <span class="text-blue-500">Website Kami</span>
                    </h2>
                    <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                        Temukan solusi terbaik untuk kebutuhan digital Anda
                        dengan layanan profesional dan berkualitas tinggi.
                    </p>
                    <div class="space-x-4">
                        <button
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105"
                        >
                            Mulai Sekarang
                        </button>
                        <button
                            class="border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white font-bold py-3 px-8 rounded-lg transition duration-300"
                        >
                            Pelajari Lebih Lanjut
                        </button>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section class="py-20 bg-white">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">
                            Fitur Unggulan
                        </h3>
                        <p class="text-gray-600 max-w-2xl mx-auto">
                            Dapatkan pengalaman terbaik dengan fitur-fitur
                            canggih yang kami tawarkan
                        </p>
                    </div>
                    <div class="grid md:grid-cols-3 gap-8">
                        <div
                            class="text-center p-6 rounded-lg hover:shadow-lg transition duration-300"
                        >
                            <div
                                class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4"
                            >
                                <svg
                                    class="w-8 h-8 text-white"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"
                                    ></path>
                                </svg>
                            </div>
                            <h4
                                class="text-xl font-semibold text-gray-900 mb-2"
                            >
                                Cepat & Responsif
                            </h4>
                            <p class="text-gray-600">
                                Website dengan performa tinggi dan loading yang
                                super cepat
                            </p>
                        </div>
                        <div
                            class="text-center p-6 rounded-lg hover:shadow-lg transition duration-300"
                        >
                            <div
                                class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4"
                            >
                                <svg
                                    class="w-8 h-8 text-white"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    ></path>
                                </svg>
                            </div>
                            <h4
                                class="text-xl font-semibold text-gray-900 mb-2"
                            >
                                Aman & Terpercaya
                            </h4>
                            <p class="text-gray-600">
                                Keamanan data terjamin dengan teknologi enkripsi
                                terdepan
                            </p>
                        </div>
                        <div
                            class="text-center p-6 rounded-lg hover:shadow-lg transition duration-300"
                        >
                            <div
                                class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4"
                            >
                                <svg
                                    class="w-8 h-8 text-white"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                    ></path>
                                </svg>
                            </div>
                            <h4
                                class="text-xl font-semibold text-gray-900 mb-2"
                            >
                                User Friendly
                            </h4>
                            <p class="text-gray-600">
                                Interface yang mudah digunakan dan intuitif
                                untuk semua kalangan
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Stats Section -->
            <section class="py-20 bg-blue-500">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div
                        class="grid md:grid-cols-4 gap-8 text-center text-white"
                    >
                        <div>
                            <div class="text-4xl font-bold mb-2">1000+</div>
                            <div class="text-blue-100">Klien Puas</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold mb-2">50+</div>
                            <div class="text-blue-100">Proyek Selesai</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold mb-2">5</div>
                            <div class="text-blue-100">Tahun Pengalaman</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold mb-2">24/7</div>
                            <div class="text-blue-100">Dukungan</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="py-20 bg-gray-900">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h3 class="text-3xl font-bold text-white mb-4">
                        Siap untuk Memulai?
                    </h3>
                    <p class="text-gray-300 mb-8 max-w-2xl mx-auto">
                        Bergabunglah dengan ribuan pengguna yang telah merasakan
                        kemudahan layanan kami
                    </p>
                    <button
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-4 px-8 rounded-lg text-lg transition duration-300 transform hover:scale-105"
                    >
                        Hubungi Kami Sekarang
                    </button>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-8">
                    <div>
                        <h4 class="text-lg font-bold text-blue-500 mb-4">
                            MyWebsite
                        </h4>
                        <p class="text-gray-400">
                            Solusi digital terpercaya untuk kebutuhan bisnis
                            Anda.
                        </p>
                    </div>
                    <div>
                        <h5 class="font-semibold mb-4">Menu</h5>
                        <ul class="space-y-2 text-gray-400">
                            <li>
                                <a
                                    href="#"
                                    class="hover:text-blue-500 transition"
                                >
                                    Home
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="hover:text-blue-500 transition"
                                >
                                    About
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="hover:text-blue-500 transition"
                                >
                                    Services
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="hover:text-blue-500 transition"
                                >
                                    Contact
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-semibold mb-4">Layanan</h5>
                        <ul class="space-y-2 text-gray-400">
                            <li>
                                <a
                                    href="#"
                                    class="hover:text-blue-500 transition"
                                >
                                    Web Development
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="hover:text-blue-500 transition"
                                >
                                    Mobile App
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="hover:text-blue-500 transition"
                                >
                                    UI/UX Design
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="hover:text-blue-500 transition"
                                >
                                    Konsultasi
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-semibold mb-4">Kontak</h5>
                        <ul class="space-y-2 text-gray-400">
                            <li>Email: info@mywebsite.com</li>
                            <li>Phone: +62 123 456 789</li>
                            <li>Alamat: Jl. Example No. 123</li>
                        </ul>
                    </div>
                </div>
                <div
                    class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400"
                >
                    <p>&copy; 2025 MyWebsite. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
