<x-guest-layout>
    <div class="flex justify-center items-center w-full min-h-screen py-10 px-4 bg-login">
        <div class="register-container">

    
            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf
    
                <div class="form-grid">
                    <!-- Name -->
                    <div class="form-group">
                        <div class="input-label">
                            <i class="fas fa-user"></i>
                            <x-input-label for="name" :value="__('Full Name')" />
                        </div>
                        <div class="input-container">
                            <input id="name" class="form-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your full name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
    
                    <!-- Email -->
                    <div class="form-group">
                        <div class="input-label">
                            <i class="fas fa-envelope"></i>
                            <x-input-label for="email" :value="__('Email Address')" />
                        </div>
                        <div class="input-container">
                            <input id="email" class="form-input" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter your email address" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
    
                    <!-- Phone Number -->
                    <div class="form-group">
                        <div class="input-label">
                            <i class="fas fa-phone"></i>
                            <label for="phone">Phone Number</label>
                        </div>
                        <div class="input-container">
                            <input type="tel" class="form-input" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number">
                        </div>
                    </div>
    
                    <!-- Gender -->
                    <div class="form-group">
                        <div class="input-label">
                            <i class="fas fa-venus-mars"></i>
                            <label for="gender">Gender</label>
                        </div>
                        <div class="select-container">
                            <select id="gender" name="gender" class="form-select">
                                <option value="" disabled selected>Select your gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <i class="fas fa-chevron-down select-arrow"></i>
                        </div>
                    </div>
                </div>
    
                <!-- Password -->
                <div class="form-group">
                    <div class="input-label">
                        <i class="fas fa-lock"></i>
                        <x-input-label for="password" :value="__('Password')" />
                    </div>
                    <div class="input-container password-container">
                        <input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" placeholder="Create a strong password" />
                        <i id="password-toggle" class="fas fa-eye password-toggle" aria-label="Toggle password visibility"></i>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
    
                <!-- Confirm Password -->
                <div class="form-group">
                    <div class="input-label">
                        <i class="fas fa-lock"></i>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    </div>
                    <div class="input-container password-container">
                        <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password" />
                        <i id="confirm-password-toggle" class="fas fa-eye password-toggle" aria-label="Toggle password visibility"></i>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
    
                <!-- Terms and Conditions -->
                <div class="form-group terms-container">
                    <label class="checkbox-container">
                        <input type="checkbox" name="terms" id="terms" required>
                        <span class="checkmark"></span>
                        <span class="terms-text">I agree to the <a href="#" class="terms-link">Terms of Service</a> and <a href="#" class="terms-link">Privacy Policy</a></span>
                    </label>
                </div>
    
                <!-- Submit Button -->
                <div class="form-footer">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-user-plus mr-2"></i>
                        <span>{{ __('Create Account') }}</span>
                    </button>
    
                    <a class="login-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt mr-1"></i>
                        <span>{{ __('Already have an account? Sign in') }}</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
    

    <!-- Enhanced CSS -->
    <style>
        /* Base Styles */
        :root {
            --primary-color: #6a11cb;
            --primary-light: #7d33d8;
            --primary-dark: #5a0cb0;
            --secondary-color: #2575fc;
            --secondary-dark: #1565e0;
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
        
        /* Global Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        .bg-login {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .register-container {
            width: 100%;
            max-width: 500px;
            padding: clamp(20px, 5vw, 40px);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            animation: fadeIn 0.5s ease-out;
            margin: clamp(10px, 3vw, 30px);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Logo and Header */
        .register-logo {
            text-align: center;
            margin-bottom: clamp(20px, 5vw, 30px);
        }
        
        
        .subtitle {
            color: var(--text-medium);
            font-size: clamp(14px, 3vw, 16px);
            margin-bottom: 10px;
        }
        
        /* Form Grid for Responsive Layout */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        @media (min-width: 640px) {
            .form-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        /* Form Groups */
        .form-group {
            margin-bottom: clamp(15px, 4vw, 20px);
        }
        
        .input-label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }
        
        .input-label i {
            color: var(--primary-color);
            font-size: clamp(14px, 3vw, 16px);
        }
        
        .input-label label {
            font-weight: 600;
            color: var(--text-dark);
            font-size: clamp(13px, 2.8vw, 14px);
        }
        
        .input-container {
            position: relative;
        }
        
        .form-input {
            width: 100%;
            padding: clamp(10px, 2.5vw, 12px) clamp(12px, 3vw, 15px);
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: clamp(14px, 3vw, 15px);
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
        
        /* Input Focus Animation */
        .input-container.input-focused .form-input {
            border-color: var(--primary-color);
            background-color: var(--bg-white);
            box-shadow: 0 0 0 3px rgba(106, 17, 203, 0.1);
        }
        
        /* Select Styling */
        .select-container {
            position: relative;
        }
        
        .form-select {
            width: 100%;
            padding: clamp(10px, 2.5vw, 12px) clamp(12px, 3vw, 15px);
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: clamp(14px, 3vw, 15px);
            transition: var(--transition);
            background-color: var(--bg-light);
            appearance: none;
            cursor: pointer;
        }
        
        .form-select:focus {
            border-color: var(--primary-color);
            background-color: var(--bg-white);
            box-shadow: 0 0 0 3px rgba(106, 17, 203, 0.1);
            outline: none;
        }
        
        .select-arrow {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            pointer-events: none;
            font-size: clamp(12px, 2.5vw, 14px);
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
            font-size: clamp(14px, 3vw, 16px);
        }
        
        .password-toggle:hover {
            color: var(--secondary-color);
        }
        
        /* Password Strength Meter */
        .password-strength-meter {
            margin-top: 8px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .strength-bar {
            height: 5px;
            background-color: var(--border-color);
            border-radius: 10px;
            overflow: hidden;
        }
        
        .strength-level {
            height: 100%;
            width: 0;
            border-radius: 10px;
            transition: var(--transition);
        }
        
        .strength-text {
            font-size: 12px;
            color: var(--text-light);
        }
        
        /* Checkbox Styling */
        .terms-container {
            margin: clamp(20px, 5vw, 25px) 0;
        }
        
        .checkbox-container {
            display: flex;
            align-items: flex-start;
            position: relative;
            padding-left: 30px;
            cursor: pointer;
            font-size: clamp(13px, 2.8vw, 14px);
            user-select: none;
            line-height: 1.5;
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
            top: 2px;
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
        
        .terms-text {
            color: var(--text-medium);
            margin-left: 5px;
        }
        
        .terms-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }
        
        .terms-link:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        /* Button Styling */
        .form-footer {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .btn-submit {
            width: 100%;
            max-width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: clamp(12px, 3vw, 14px);
            border-radius: var(--radius-md);
            border: none;
            font-size: clamp(15px, 3.2vw, 16px);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: var(--shadow-md);
        }
        
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 100%);
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }
        
        .btn-submit i {
            font-size: clamp(14px, 3vw, 16px);
        }
        
        /* Divider */
        .divider {
            width: 100%;
            text-align: center;
            margin: clamp(20px, 5vw, 25px) 0;
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
            font-size: clamp(13px, 2.8vw, 14px);
        }

        
        /* Login Link */
        .login-link {
            color: var(--text-medium);
            text-decoration: none;
            font-size: clamp(13px, 2.8vw, 14px);
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .login-link:hover {
            color: var(--primary-color);
        }
        
        /* Error Messages */
        .mt-2 {
            margin-top: 8px;
            color: #e53e3e;
            font-size: clamp(12px, 2.5vw, 13px);
        }
        
        /* Responsive Adjustments */
        @media (max-width: 480px) {
            .register-container {
                padding: 25px 15px;
                border-radius: var(--radius-md);
            }
            
            .form-group {
                margin-bottom: 15px;
            }
            
            .terms-container {
                margin: 15px 0;
            }
            
            .checkbox-container {
                padding-left: 28px;
            }
            
            .checkmark {
                width: 18px;
                height: 18px;
            }
            
            .checkbox-container .checkmark:after {
                left: 5px;
                top: 2px;
                width: 4px;
                height: 8px;
            }
        }
        
        @media (min-width: 481px) and (max-width: 768px) {
            .register-container {
                max-width: 90%;
            }
        }
        
        @media (min-width: 769px) and (max-width: 1024px) {
            .register-container {
                max-width: 80%;
            }
        }
        
        @media (min-width: 1025px) {
            .register-container {
                max-width: 500px;
            }
        }
        
        /* Landscape Mode Adjustments */
        @media (max-height: 600px) and (orientation: landscape) {
            .register-container {
                margin: 10px auto;
                max-height: 90vh;
                overflow-y: auto;
                padding: 20px;
            }
            
            .logo-icon {
                width: 50px;
                height: 50px;
                margin-bottom: 10px;
            }
            
            .register-logo h2 {
                font-size: 22px;
                margin-bottom: 2px;
            }
            
            .subtitle {
                font-size: 14px;
                margin-bottom: 15px;
            }
            
            .form-group {
                margin-bottom: 12px;
            }
        }
        

    </style>

    <!-- JavaScript for Enhanced Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle functionality
            document.getElementById('password-toggle').addEventListener('click', function() {
                togglePasswordVisibility('password', 'password-toggle');
            });
            
            document.getElementById('confirm-password-toggle').addEventListener('click', function() {
                togglePasswordVisibility('password_confirmation', 'confirm-password-toggle');
            });
            
            function togglePasswordVisibility(inputId, toggleId) {
                var passwordInput = document.getElementById(inputId);
                var toggleIcon = document.getElementById(toggleId);
                
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
            }
            

            
            // Form validation
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                // Basic form validation
                let isValid = true;
                const requiredInputs = form.querySelectorAll('[required]');
                
                requiredInputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.parentElement.classList.add('input-error');
                    } else {
                        input.parentElement.classList.remove('input-error');
                    }
                });
                
                // Email validation
                const emailInput = document.getElementById('email');
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailInput.value && !emailPattern.test(emailInput.value)) {
                    isValid = false;
                    emailInput.parentElement.classList.add('input-error');
                }
                
                // Password match validation
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;
                
                if (password && confirmPassword && password !== confirmPassword) {
                    isValid = false;
                    document.getElementById('password_confirmation').parentElement.classList.add('input-error');
                }
                
                if (!isValid) {
                    event.preventDefault();
                }
            });
            
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