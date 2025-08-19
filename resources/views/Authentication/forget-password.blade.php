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
                    class="flex items-center w-fit py-2.5 px-3 mb-8 text-left border border-transparent rounded-xl shadow-sm text-xs font-semibold text-white bg-slate-500 hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]"
                >
                    <x-gmdi-arrow-back-ios-new-o class="w-3 h-3 mr-2" />
                    Back to login
                </a>
                <div class="text-center mb-8">
                    <div
                        class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4"
                    >
                        <x-gmdi-lock-o class="w-8 h-8 text-white" />
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        Trouble logging in?
                    </h1>
                    <p class="text-gray-600 w-sm mx-auto">
                        Enter your Email Address and we'll send you a link to
                        get back into your account.
                    </p>
                </div>

                <form
                    class="space-y-6"
                    method="POST"
                    action="{{ route('authentication.forget-password.action') }}"
                >
                    @csrf
                    <div class="relative">
                        <input
                            type="text"
                            id="email"
                            name="email"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all duration-200 bg-gray-50 focus:bg-white"
                            placeholder="Email address"
                        />
                    </div>

                    <button
                        type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]"
                    >
                        Send login link
                    </button>
                </form>

                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">OR</span>
                        </div>
                    </div>

                    <div class="mt-6 text-center">
                        <a
                            href="{{ route('authentication.register') }}"
                            class="font-medium text-blue-600 hover:text-blue-500 transition"
                        >
                            Create new account
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script>
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
