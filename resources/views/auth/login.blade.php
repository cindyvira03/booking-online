<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" onsubmit="disableSubmitButton(this)">
        @csrf

        <!-- Login Field (Email atau Nomor Telepon) -->
        <div>
            <x-input-label for="login" :value="__('Email atau Nomor Telepon')" />
            <x-text-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" required
                autofocus />
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required
                    autocomplete="current-password" />
                <button type="button" onclick="togglePassword()"
                    class="text-xl absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 focus:outline-none">
                    <i class='bx bx-show-alt' id="eyeOpen" style="display:none;"></i>
                    <i class='bx bx-low-vision' id="eyeClosed"></i>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="mt-2">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="mt-4">
            <x-primary-button class="w-full justify-center">
                {{ __('Log in') }}
            </x-primary-button>
            <p class="text-center text-gray-700 mt-4">
                Belum punya akun? <a href="{{ route('register') }}"
                    class="text-indigo-600 hover:text-indigo-900 font-semibold">
                    {{ __('Register') }}
                </a>
            </p>
        </div>
    </form>

<<<<<<< HEAD
    <!-- Divider -->
    <div class="mt-6 flex items-center justify-center">
        <div class="border-t border-gray-300 w-1/3"></div>
        <span class="mx-3 text-gray-500 text-sm">atau</span>
        <div class="border-t border-gray-300 w-1/3"></div>
    </div>

    <!-- Google Login Button -->
    <div class="mt-6 flex justify-center">
        <a href="{{ route('google.redirect') }}"
            class="flex items-center justify-center gap-2 w-full sm:w-auto bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-md shadow-sm hover:bg-gray-100 transition">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Logo" class="w-5 h-5">
            <span>Login with Google</span>
        </a>
    </div>
=======
    <script>
        function disableSubmitButton(form) {
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.classList.add('opacity-70', 'cursor-not-allowed');
                if (!submitButton.dataset.originalText) {
                    submitButton.dataset.originalText = submitButton.innerHTML;
                }
                submitButton.innerHTML = 'Memuat...';
            }
        }

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.style.display = '';
                eyeClosed.style.display = 'none';
            } else {
                passwordInput.type = 'password';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = '';
            }
        }
    </script>
>>>>>>> 94e7d3b (Implement user authentication features and enhance UI components)
</x-guest-layout>
