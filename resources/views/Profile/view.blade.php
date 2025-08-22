<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Profile - MyWebsite</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-white-100">
        <div class="relative w-full h-72 bg-gray-300">
            <img src="https://picsum.photos/1200/400"
                    class="w-full h-full object-fit" alt="Cover">
            <div class="absolute -bottom-24 left-10">
                <img src="https://picsum.photos/200/300"
                        class="w-36 h-36 rounded-full border-4 border-white shadow-lg"
                        alt="Profile">
            </div>
        </div>
        <div class="max-w-5xl mx-auto px-1 pt-20 pb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">John Doe</h1>
            </div>
        </div>
        <div class="max-w-5xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1 space-y-4">
                <div class="bg-white rounded-lg shadow p-4">
                    <h2 class="text-lg font-bold mb-2">Tentang</h2>
                    <p class="text-gray-700">Belajar programming di Universitas X.</p>
                </div>
            </div>
            <div class="md:col-span-2 space-y-4">
                <div class="bg-gray-10 rounded-lg shadow p-4">
                    <textarea placeholder="Apa yang Anda pikirkan?"
                                class="w-full border rounded-lg p-2"></textarea>
                    <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded-lg">Posting</button>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center mb-2">
                        <img src="https://picsum.photos/50/50" class="w-10 h-10 rounded-full" />
                        <div class="ml-3">
                            <p class="font-semibold">John Doe</p>
                            <p class="text-sm text-gray-500">2 jam yang lalu</p>
                        </div>
                    </div>
                    <p class="text-gray-800 mb-2">Hari ini belajar Laravel, seru banget! 🚀</p>
                    <img src="https://picsum.photos/600/300" class="rounded-lg" />
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center mb-2">
                        <img src="https://picsum.photos/50/50" class="w-10 h-10 rounded-full" />
                        <div class="ml-3">
                            <p class="font-semibold">John Doe</p>
                            <p class="text-sm text-gray-500">2 jam yang lalu</p>
                        </div>
                    </div>
                    <p class="text-gray-800 mb-2">Hari ini belajar Laravel, seru banget! 🚀</p>
                    <img src="https://picsum.photos/600/300" class="rounded-lg" />
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center mb-2">
                        <img src="https://picsum.photos/50/50" class="w-10 h-10 rounded-full" />
                        <div class="ml-3">
                            <p class="font-semibold">John Doe</p>
                            <p class="text-sm text-gray-500">2 jam yang lalu</p>
                        </div>
                    </div>
                    <p class="text-gray-800 mb-2">Hari ini belajar Laravel, seru banget! 🚀</p>
                    <img src="https://picsum.photos/600/300" class="rounded-lg" />
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center mb-2">
                        <img src="https://picsum.photos/50/50" class="w-10 h-10 rounded-full" />
                        <div class="ml-3">
                            <p class="font-semibold">John Doe</p>
                            <p class="text-sm text-gray-500">2 jam yang lalu</p>
                        </div>
                    </div>
                    <p class="text-gray-800 mb-2">Hari ini belajar Laravel, seru banget! 🚀</p>
                    <img src="https://picsum.photos/600/300" class="rounded-lg" />
                </div>
            </div>
        </div>
    </body>
</html>
