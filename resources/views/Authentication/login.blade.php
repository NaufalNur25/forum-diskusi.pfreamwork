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
        <div class="w-full max-w-md">
            @if (session('error'))
                <div
                    class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50"
                    role="alert"
                >
                    <x-gmdi-error
                        class="shrink-0 inline w-4 h-4 me-3"
                        aria-hidden="true"
                    />
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Error alert!</span>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <div
                class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8"
            >
                <div class="text-center mb-8">
                    <div
                        class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4"
                    >
                        <x-gmdi-person class="w-8 h-8 text-white" />
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        Welcome Back
                    </h1>
                    <p class="text-gray-600">Sign in to your account</p>
                </div>

                <form
                    class="space-y-6"
                    method="POST"
                    action="{{ route('authentication.login.action') }}"
                >
                    @csrf
                    <div class="space-y-2">
                        <label
                            for="login"
                            class="block text-sm font-semibold text-gray-700"
                        >
                            Email Address
                        </label>
                        <div class="relative">
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="w-full px-4 py-3 rounded-xl border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all duration-200 bg-gray-50 focus:bg-white"
                                placeholder="Enter your email address"
                                value="{{ old('email') }}"
                            />
                            <div
                                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                            >
                                <x-gmdi-alternate-email-o
                                    class="w-5 h-5 text-gray-400"
                                />
                            </div>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

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
                                value="{{ old('password') }}"
                            />
                            <button
                                type="button"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                onclick="togglePassword()"
                            >
                                <x-gmdi-remove-red-eye-o
                                    id="eye-open"
                                    class="w-5 h-5 text-gray-400 hover:text-gray-600 transition-colors"
                                />
                                <x-gmdi-remove-red-eye-r
                                    id="eye-closed"
                                    class="w-5 h-5 text-gray-400 hover:text-gray-600 transition-colors hidden"
                                />
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input
                                id="remember"
                                name="remember"
                                type="checkbox"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer"
                                value="{{true}}"
                            />
                            <label
                                for="remember-me"
                                class="ml-2 text-sm text-gray-700 cursor-pointer"
                            >
                                Remember me
                            </label>
                        </div>
                        <div class="text-sm">
                            <a
                                href="{{ route('authentication.forget-password') }}"
                                class="font-medium text-blue-600 hover:text-blue-500 transition-colors"
                            >
                                Forgot password?
                            </a>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]"
                    >
                        <x-gmdi-login class="w-5 h-5 mr-2" />
                        Sign In
                    </button>
                </form>

                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">
                                Don't have an account?
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 text-center">
                        <a
                            href="{{ route('authentication.register') }}"
                            class="font-medium text-blue-600 hover:text-blue-500 transition-colors"
                        >
                            Create an account
                        </a>
                    </div>
                </div>
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
