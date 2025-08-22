@extends('Layouts.app')

@section('content')
    <section class="bg-gradient-to-b from-blue-50 to-white py-20 h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                Selamat Datang di
                <span class="text-blue-500">Website Kami</span>
            </h2>
            <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                Temukan solusi terbaik untuk kebutuhan digital Anda
                dengan layanan profesional dan berkualitas tinggi.
            </p>
            <div class="space-x-4">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105">
                    Mulai Sekarang
                </button>
                <button class="border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white font-bold py-3 px-8 rounded-lg transition duration-300">
                    Pelajari Lebih Lanjut
                </button>
            </div>
        </div>
    </section>
@endsection
