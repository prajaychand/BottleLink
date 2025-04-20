<x-guest-layout>
    <!-- Login Page Container -->
    <div class="flex justify-center items-center w-full min-h-screen py-10 px-4 bg-login">
        @if (session('success'))
            <div class="alert-success">
                <div class="alert-content">
                    <i class="fas fa-check-circle alert-icon"></i>
                    <p>{{ session('success') }}</p>
                </div>
                <button class="alert-close">&times;</button>
            </div>
        @endif
        
        <div class="login-container">
            <!-- Logo and Header -->
            <div class="login-header">
                <div class="login-logo">
                    <i class="fas fa-lock-open"></i>
                </div>
                <h2>Welcome Back</h2>
                <p class="login-subtitle">Sign in to your account</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <div class="input-label">
                        <i class="fas fa-envelope"></i>
                        <x-input-label for="email" :value="__('Email Address')" />
                    </div>
                    <div class="input-container">
                        <input id="email" class="form-input" type="email" name="email" 
                            :value="old('email')" required autofocus autocomplete="username" 
                            placeholder="Enter your email" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <div class="input-label">
                        <i class="fas fa-lock"></i>
                        <x-input-label for="password" :value="__('Password')" />
                    </div>
                    <div class="input-container password-container">
                        <input id="password" class="form-input" type="password" name="password"
                            required autocomplete="current-password" placeholder="Enter your password" />
                        <i id="password-toggle" class="fas fa-eye password-toggle" aria-label="Toggle password visibility"></i>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me and Forgot Password -->
                <div class="form-options">
                    <div class="remember-me">
                        <label for="remember_me" class="checkbox-container">
                            <input id="remember_me" type="checkbox" name="remember">
                            <span class="checkmark"></span>
                            <span>{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    
                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="form-action">
                    <x-primary-button class="btn-submit">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        <span>{{ __('Sign In') }}</span>
                    </x-primary-button>
                </div>
                
            
                
                <!-- Register Link -->
                <div class="register-link">
                    <p>Don't have an account?</p>
                    <a href="{{ route('register') }}">Create Account</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Enhanced CSS -->
    <style>
        /* Base Styles */
        :root {
            --primary-color: #6a11cb;
            --primary-hover: #5a0cb0;
            --secondary-color: #2575fc;
            --text-dark: #333;
            --text-medium: #666;
            --text-light: #888;
            --border-color: #e1e1e1;
            --bg-light: #f9f9f9;
            --bg-white: #ffffff;
            --shadow-sm: 0 5px 15px rgba(0,0,0,0.1);
            --shadow-md: 0 10px 25px rgba(0,0,0,0.15);
            --shadow-lg: 0 20px 40px rgba(0,0,0,0.2);
            --radius-sm: 5px;
            --radius-md: 10px;
            --radius-lg: 20px;
            --transition: all 0.3s ease;
        }
        
        /* Background */
        .bg-login {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        /* Container */
        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            animation: fadeIn 0.5s ease-out;
            margin: 20px;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Header and Logo */
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-logo {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border-radius: 50%;
            margin-bottom: 15px;
            box-shadow: 0 10px 20px rgba(106, 17, 203, 0.3);
            transition: var(--transition);
        }
        
        .login-logo i {
            font-size: 30px;
            color: white;
        }
        
        .login-header h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--text-dark);
        }
        
        .login-subtitle {
            color: var(--text-medium);
            font-size: 16px;
        }
        
        /* Form Groups */
        .form-group {
            margin-bottom: 20px;
        }
        
        .input-label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }
        
        .input-label i {
            color: var(--primary-color);
            font-size: 16px;
        }
        
        .input-label label {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 14px;
        }
        
        .input-container {
            position: relative;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 15px;
            transition: var(--transition);
            background-color: var(--bg-light);
        }
        
        .form-input:focus {
            border-color: var(--primary-color);
            background-color: var(--bg-white);
            box-shadow: 0 0 0 3px rgba(106, 17, 203, 0.1);
            outline: none;
        }
        
        .form-input::placeholder {
            color: var(--text-light);
            opacity: 0.8;
        }
        
        /* Password Field */
        .password-container {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            cursor: pointer;
            transition: var(--transition);
        }
        
        .password-toggle:hover {
            color: var(--secondary-color);
        }
        
        /* Remember Me and Forgot Password */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        /* Checkbox Styling */
        .checkbox-container {
            display: flex;
            align-items: center;
            position: relative;
            padding-left: 30px;
            cursor: pointer;
            font-size: 14px;
            user-select: none;
            color: var(--text-medium);
        }
        
        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }
        
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: var(--bg-light);
            border: 2px solid var(--border-color);
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }
        
        .checkbox-container:hover input ~ .checkmark {
            background-color: #f0f0f0;
        }
        
        .checkbox-container input:checked ~ .checkmark {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }
        
        .checkbox-container input:checked ~ .checkmark:after {
            display: block;
        }
        
        .checkbox-container .checkmark:after {
            left: 6px;
            top: 2px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        
        .forgot-password {
            color: var(--primary-color);
            font-size: 14px;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .forgot-password:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        
        /* Button Styling */
        .form-action {
            margin-bottom: 25px;
        }
        
        .btn-submit {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 14px;
            border-radius: var(--radius-md);
            border: none;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: var(--shadow-md);
        }
        
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
            background: linear-gradient(135deg, #5a0cb0 0%, #1565e0 100%);
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }
        
        /* Divider */
        .divider {
            width: 100%;
            text-align: center;
            margin: 25px 0;
            position: relative;
        }
        
        .divider::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: var(--border-color);
        }
        
        .divider span {
            position: relative;
            background-color: white;
            padding: 0 15px;
            color: var(--text-light);
            font-size: 14px;
        }
        
        /* Social Login */
        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .social-btn {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border-radius: var(--radius-md);
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }
        
        .google-btn {
            background-color: #DB4437;
        }
        
        .facebook-btn {
            background-color: #4267B2;
        }
        
        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            opacity: 0.95;
        }
        
        /* Register Link */
        .register-link {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }
        
        .register-link p {
            color: var(--text-medium);
        }
        
        .register-link a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }
        
        .register-link a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        
        /* Alert Styling */
        .alert-success {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #10b981;
            color: white;
            padding: 15px 20px;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
            display: flex;
            justify-content: space-between;
            align-items: center;
            animation: slideIn 0.3s ease-out;
            z-index: 1000;
            max-width: 90%;
        }
        
        .alert-content {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .alert-icon {
            font-size: 20px;
        }
        
        .alert-close {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            padding: 0 5px;
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        /* Error Messages */
        .mt-2 {
            margin-top: 8px;
            color: #e53e3e;
            font-size: 13px;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
                margin: 15px;
                border-radius: var(--radius-md);
            }
            
            .login-logo {
                width: 60px;
                height: 60px;
            }
            
            .login-logo i {
                font-size: 25px;
            }
            
            .login-header h2 {
                font-size: 24px;
            }
            
            .login-subtitle {
                font-size: 14px;
            }
            
            .form-input {
                padding: 10px 12px;
                font-size: 14px;
            }
            
            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .forgot-password {
                align-self: flex-end;
            }
            
            .btn-submit {
                padding: 12px;
                font-size: 15px;
            }
            
            .social-login {
                flex-direction: column;
                gap: 10px;
            }
        }
        
        @media (min-width: 481px) and (max-width: 768px) {
            .login-container {
                max-width: 90%;
            }
            
            .form-options {
                flex-wrap: wrap;
                gap: 10px;
            }
        }
        
        /* Landscape Mode Adjustments */
        @media (max-height: 600px) and (orientation: landscape) {
            .login-container {
                margin: 10px auto;
                max-height: 90vh;
                overflow-y: auto;
                padding: 20px;
            }
            
            .login-logo {
                width: 50px;
                height: 50px;
                margin-bottom: 10px;
            }
            
            .login-header h2 {
                font-size: 22px;
                margin-bottom: 2px;
            }
            
            .login-subtitle {
                font-size: 14px;
                margin-bottom: 15px;
            }
            
            .form-group {
                margin-bottom: 15px;
            }
        }
        
        /* Dark Mode Support */
        @media (prefers-color-scheme: dark) {
            .login-container {
                background: rgba(30, 30, 30, 0.95);
                color: #f0f0f0;
            }
            
            .login-header h2 {
                color: #f0f0f0;
            }
            
            .login-subtitle {
                color: #c0c0c0;
            }
            
            .input-label label {
                color: #e0e0e0;
            }
            
            .form-input {
                background-color: rgba(50, 50, 50, 0.8);
                border-color: #444;
                color: #f0f0f0;
            }
            
            .form-input::placeholder {
                color: #999;
            }
            
            .form-input:focus {
                background-color: rgba(60, 60, 60, 0.9);
                border-color: var(--primary-color);
            }
            
            .divider span {
                background-color: #1e1e1e;
                color: #c0c0c0;
            }
            
            .checkbox-container {
                color: #c0c0c0;
            }
            
            .checkmark {
                background-color: #333;
                border-color: #555;
            }
            
            .register-link p {
                color: #c0c0c0;
            }
        }
        
        /* Accessibility Improvements */
        .form-input:focus, .btn-submit:focus, .social-btn:focus, .forgot-password:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }
    </style>

    <!-- JavaScript for Enhanced Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle functionality
            document.getElementById('password-toggle').addEventListener('click', function() {
                var passwordInput = document.getElementById('password');
                var toggleIcon = document.getElementById('password-toggle');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                    toggleIcon.setAttribute('aria-label', 'Hide password');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                    toggleIcon.setAttribute('aria-label', 'Show password');
                }
            });
            
            // Form input focus effects
            const formInputs = document.querySelectorAll('.form-input');
            
            formInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('input-focused');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('input-focused');
                });
            });
            
            // Alert close functionality
            const alertClose = document.querySelector('.alert-close');
            if (alertClose) {
                alertClose.addEventListener('click', function() {
                    const alert = this.closest('.alert-success');
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 300);
                });
                
                // Auto-hide alert after 5 seconds
                setTimeout(() => {
                    const alert = document.querySelector('.alert-success');
                    if (alert) {
                        alert.style.opacity = '0';
                        alert.style.transform = 'translateX(100%)';
                        setTimeout(() => {
                            alert.style.display = 'none';
                        }, 300);
                    }
                }, 5000);
            }

            
            // Responsive height adjustment for mobile devices
            function adjustHeight() {
                const vh = window.innerHeight * 0.01;
                document.documentElement.style.setProperty('--vh', `${vh}px`);
            }
            
            // Set initial height and adjust on resize
            adjustHeight();
            window.addEventListener('resize', adjustHeight);
        });
    </script>
</x-guest-layout>