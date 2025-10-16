<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" onsubmit="disableSubmitButton(this)">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Nomer Telepon')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="tel" name="phone_number"
                :value="old('phone_number')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required
                    autocomplete="new-password" />
                <button type="button" onclick="togglePassword()"
                    class="text-xl absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 focus:outline-none">
                    <i class='bx bx-show-alt' id="eyeOpen" style="display:none;"></i>
                    <i class='bx bx-low-vision' id="eyeClosed"></i>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        {{-- <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div> --}}

        <div class="mt-4">
            <x-primary-button class="w-full justify-center">
                {{ __('Register') }}
            </x-primary-button>
            <p class="text-center text-gray-700 mt-4">
                Sudah punya akun? <a href="{{ route('login') }}"
                    class="text-indigo-600 hover:text-indigo-900 font-semibold">
                    {{ __('Login') }}
                </a>
            </p>
        </div>
    </form>

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
</x-guest-layout>
