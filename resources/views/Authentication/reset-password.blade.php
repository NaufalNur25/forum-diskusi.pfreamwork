<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/css/app.css')
    </head>
    <body
        class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 flex items-center justify-center p-4"
    >
        <div class="w-full max-w-lg">
            <div
                class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8"
            >
                <a
                    href="{{ route('authentication.login') }}"
                    class="flex items-center w-fit py-2.5 px-3 mb-8 border border-transparent rounded-xl shadow-sm text-xs font-semibold text-white bg-slate-500 hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]"
                >
                    <x-gmdi-cancel-o class="w-4 h-4 mr-2" />
                    Cancle
                </a>
                <div class="text-center mb-8">
                    <div
                        class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4"
                    >
                        <x-gmdi-password class="w-8 h-8 text-white" />
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        Reset your password
                    </h1>
                </div>

                <form
                    class="space-y-6"
                    method="POST"
                    action="{{ route('authentication.reset-password.action') }}"
                >
                    @csrf
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="hidden"
                        aria-hidden="true"
                        value="{{ $email }}"
                    />

                    <input
                        type="token"
                        id="token"
                        name="token"
                        class="hidden"
                        aria-hidden="true"
                        value="{{ $token }}"
                    />

                    <div class="space-y-2">
                        <label
                            for="password"
                            class="block text-sm font-semibold text-gray-700"
                        >
                            Password
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="w-full px-4 py-3 rounded-xl border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all duration-200 bg-gray-50 focus:bg-white"
                                placeholder="Enter your password"
                            />
                            <button
                                type="button"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                onclick="togglePassword()"
                            >
                                <x-gmdi-remove-red-eye-o
                                    id="eye-open"
                                    class="w-5 h-5 {{ $errors->has('password') ? 'text-red-500' : 'text-gray-400' }}"
                                />
                                <x-gmdi-remove-red-eye-r
                                    id="eye-closed"
                                    class="w-5 h-5 {{ $errors->has('password') ? 'text-red-500' : 'text-gray-400' }} hidden"
                                />
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label
                            for="password_confirmation"
                            class="block text-sm font-semibold text-gray-700"
                        >
                            Password Confirmation
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="w-full px-4 py-3 pr-12 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all duration-200 bg-gray-50 focus:bg-white"
                                placeholder="Re-enter your password for confirmation"
                            />
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]"
                    >
                        Make new password
                    </button>
                </form>
            </div>
        </div>

        <script>
            function togglePassword() {
                const passwordInput = document.getElementById('password')
                const eyeOpen = document.getElementById('eye-open')
                const eyeClosed = document.getElementById('eye-closed')

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text'
                    eyeOpen.classList.add('hidden')
                    eyeClosed.classList.remove('hidden')
                } else {
                    passwordInput.type = 'password'
                    eyeOpen.classList.remove('hidden')
                    eyeClosed.classList.add('hidden')
                }
            }

            document.querySelectorAll('input').forEach((input) => {
                input.addEventListener('focus', function () {
                    this.parentElement.classList.add('animate-pulse')
                })

                input.addEventListener('blur', function () {
                    this.parentElement.classList.remove('animate-pulse')
                })
            })
        </script>
    </body>
</html>
