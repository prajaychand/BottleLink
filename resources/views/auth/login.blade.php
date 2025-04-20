<x-guest-layout>
    <!-- Outer Div for Form Container -->
    <div class="flex justify-center items-center w-full h-screen bg-login">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="login-container">
            <!-- Logo or Title -->
            <div class="login-logo">
                <h2>Login</h2>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-envelope text-gray-500"></i> <!-- Email Icon -->
                        <x-input-label for="email" :value="__('Email')" />
                    </div>
                    <div class="relative">
                        <input id="email" class="block mt-1 w-full pr-10 pl-4" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-group mt-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-lock text-gray-500"></i> <!-- Password Icon -->
                        <x-input-label for="password" :value="__('Password')" />
                    </div>
                    <div class="relative">
                        <input id="password" class="block mt-1 w-full pr-10 pl-4" type="password" name="password"
                            required autocomplete="current-password" />
                        <i id="password-toggle"
                            class="fas fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 cursor-pointer"></i>
                        <!-- Eye Icon for Toggle -->
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="form-group mt-4 flex items-center">
                    <label for="remember_me" class="inline-flex items-center gap-2">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" name="remember">
                        <span class="text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Forgot Password and Submit Button -->
                <div class="form-footer mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="btn-submit">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
                <div class="mt-4 text-center">
                    <span class="text-sm text-gray-600">Don't have an account?</span>
                    <a href="{{ route('register') }}" class="text-sm text-red-500 hover:underline">Register</a>
                </div>

            </form>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        /* Form Container Styling */
        .login-container {
            width: 100%;
            max-width: 380px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        /* Logo or Title */
        .login-logo h2 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
            color: #333;
            transition: font-size 0.3s ease;
        }

        /* Form Elements */
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

        .form-footer {
            text-align: center;
        }

        .btn-submit {
            width: 70%;
            justify-content: center;
            background-color:rgb(147,7,231);
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

        /* Icon Styling */
        .fa-envelope,
        .fa-lock,
        .fa-eye {
            font-size: 18px;
        }

        /* Password Toggle */
        #password-toggle {
            right: 10px;
            top: 15px;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                padding: 30px;
            }

            .login-logo h2 {
                font-size: 28px;
            }

            .form-group input {
                font-size: 14px;
            }

            .btn-submit {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .login-logo h2 {
                font-size: 24px;
            }

            .form-group input {
                padding: 8px;
                font-size: 14px;
            }

            .btn-submit {
                padding: 10px;
            }

            .fa-envelope,
            .fa-lock,
            .fa-eye {
                font-size: 16px;
            }

            /* Adjust the form container to fit smaller screens */
            .login-container {
                max-width: 90%;
                padding: 20px;
            }

            .form-group input {
                padding: 8px;
                font-size: 14px;
            }
        }
    </style>

    <!-- JavaScript for Password Visibility Toggle -->
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