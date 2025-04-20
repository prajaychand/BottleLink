<x-guest-layout>
    <div class="flex justify-center items-center w-full h-screen bg-login">
        <div class="register-container">
            <div class="register-logo">
                <h2>Register</h2>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-user text-gray-500"></i> <!-- Name Icon -->
                        <x-input-label for="name" :value="__('Name')" />
                    </div>
                    <input id="name" class="block mt-1 w-full pr-10 pl-4" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="form-group mt-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-envelope text-gray-500"></i> <!-- Email Icon -->
                        <x-input-label for="email" :value="__('Email')" />
                    </div>
                    <input id="email" class="block mt-1 w-full pr-10 pl-4" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-group mt-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-lock text-gray-500"></i> <!-- Password Icon -->
                        <x-input-label for="password" :value="__('Password')" />
                    </div>
                    <div class="relative">
                        <input id="password" class="block mt-1 w-full pr-10 pl-4" type="password" name="password" required autocomplete="new-password" />
                        <i id="password-toggle" class="fas fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 cursor-pointer"></i>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="form-group mt-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-lock text-gray-500"></i> <!-- Confirm Password Icon -->
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    </div>
                    <input id="password_confirmation" class="block mt-1 w-full pr-10 pl-4" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="form-footer mt-4 flex flex-col items-center">
                    <x-primary-button class="btn-submit">
                        {{ __('Register') }}
                    </x-primary-button>
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 mt-2" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>

            </form>
        </div>
    </div>

    <!-- Custom CSS (reuse from login) -->
    <style>
        /* Reuse login styles */
        .register-container {
            width: 100%;
            max-width: 380px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .register-logo h2 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-top: 5px;
            font-size: 16px;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-submit {
            width: 100%;
            /* Make button take full width if needed */
            max-width: 200px;
            /* Set a maximum width for aesthetics */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgb(147, 7, 231);
            color: white;
            padding: 12px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 1rem;
        }

        .btn-submit:hover {
            background-color: red;
        }

        .form-footer {
            display: flex;
            flex-direction: column;
            /* Stack elements vertically */
            align-items: center;
            /* Center elements horizontally */
            justify-content: center;
            /* Center elements vertically */
        }
    </style>

    <!-- JavaScript for Password Toggle -->
    <script>
        document.getElementById('password-toggle').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            var passwordToggleIcon = document.getElementById('password-toggle');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggleIcon.classList.remove('fa-eye');
                passwordToggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggleIcon.classList.remove('fa-eye-slash');
                passwordToggleIcon.classList.add('fa-eye');
            }
        });
    </script>
</x-guest-layout>