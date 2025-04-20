<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="password-reset-card">
                    <div class="card-decoration">
                        <div class="reset-icon-container">
                            <i class="fas fa-shield-alt reset-icon-main"></i>
                        </div>
                    </div>

                    <div class="card-content">
                        <h3 class="card-title">
                            <i class="fas fa-lock me-2"></i>{{ __('Create New Password') }}
                        </h3>

                        <div class="card-description">
                            <p>
                                {{ __('Your password reset link has been verified. Please set your new password below.') }}
                            </p>
                        </div>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            
                            {{-- <!-- Email Address -->
                            <div class="form-group">
                                <label class="form-label" for="email">{{ __('Email Address') }}</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-envelope input-icon"></i>
                                    <x-text-input id="email" class="form-input disabled-input" type="email"
                                        name="email" :value=":value="old('email', $email)" " required readonly autocomplete="username" />
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="input-error" />
                            </div> --}}

                            <!-- Password -->
                            <div class="form-group">
                                <label class="form-label" for="password">{{ __('New Password') }}</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-lock input-icon"></i>
                                    <x-text-input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" placeholder="Enter your new password" />
                                    <i id="password-toggle" class="fas fa-eye password-toggle-icon"></i>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="input-error" />
                                
                                
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <label class="form-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-lock input-icon"></i>
                                    <x-text-input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your new password" />
                                    <i id="confirm-password-toggle" class="fas fa-eye password-toggle-icon"></i>
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="input-error" />
                                <div id="password-match" class="password-match"></div>
                            </div>

                            <div class="form-actions">
                                <x-primary-button class="reset-button">
                                    <i class="fas fa-check-circle me-2"></i>{{ __('Reset Password') }}
                                </x-primary-button>
                                
                                <a href="{{ route('login') }}" class="back-link">
                                    <i class="fas fa-arrow-left me-1"></i>{{ __('Back to Login') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Enhanced Custom Styles */
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        
        .password-reset-card {
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            margin: 20px 0;
            transition: all 0.3s ease;
        }
        
        .password-reset-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .card-decoration {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            height: 120px;
            position: relative;
            display: flex;
            justify-content: center;
        }
        
        .reset-icon-container {
            width: 90px;
            height: 90px;
            background-color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 75px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            border: 5px solid #ffffff;
        }
        
        .reset-icon-main {
            font-size: 36px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .card-content {
            padding: 60px 30px 30px;
        }
        
        .card-title {
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }
        
        .card-description {
            text-align: center;
            color: #666;
            font-size: 15px;
            margin-bottom: 30px;
            padding: 0 10px;
            line-height: 1.6;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 15px;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6a11cb;
            font-size: 18px;
        }
        
        .form-input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #e1e1e1;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }
        
        .form-input:focus {
            border-color: #6a11cb;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(106, 17, 203, 0.1);
            outline: none;
        }
        
        .form-input::placeholder {
            color: #aaa;
        }
        
        .disabled-input {
            background-color: #f0f0f0;
            cursor: not-allowed;
            color: #666;
        }
        
        .password-toggle-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6a11cb;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 18px;
        }
        
        .password-toggle-icon:hover {
            color: #2575fc;
        }
        
        .input-error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 8px;
            display: block;
        }
        
        /* Password Strength Meter */
        .password-strength-meter {
            margin-top: 15px;
        }
        
        .strength-bar {
            height: 6px;
            background-color: #e1e1e1;
            border-radius: 3px;
            margin-bottom: 8px;
            overflow: hidden;
        }
        
        .strength-level {
            height: 100%;
            width: 0;
            border-radius: 3px;
            transition: all 0.3s ease;
        }
        
        .strength-text {
            font-size: 13px;
            color: #666;
        }
        
        /* Password Requirements */
        .password-requirements {
            margin-top: 15px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #6a11cb;
        }
        
        .requirements-title {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        
        .requirements-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        
        .requirements-list li {
            font-size: 13px;
            color: #666;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .requirements-list li i {
            font-size: 12px;
            color: #aaa;
        }
        
        .requirements-list li.valid {
            color: #198754;
        }
        
        .requirements-list li.valid i {
            color: #198754;
        }
        
        /* Password Match Indicator */
        .password-match {
            font-size: 13px;
            margin-top: 8px;
        }
        
        .password-match.match {
            color: #198754;
        }
        
        .password-match.no-match {
            color: #dc3545;
        }
        
        .form-actions {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            margin-top: 30px;
        }
        
        .reset-button {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 15px;
            border-radius: 10px;
            border: none;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.2);
        }
        
        .reset-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(106, 17, 203, 0.3);
        }
        
        .reset-button:active {
            transform: translateY(0);
        }
        
        .back-link {
            color: #666;
            text-decoration: none;
            font-size: 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .back-link:hover {
            color: #6a11cb;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .password-reset-card {
                margin: 10px;
            }
            
            .card-content {
                padding: 50px 20px 25px;
            }
            
            .reset-icon-container {
                width: 80px;
                height: 80px;
                top: 80px;
            }
            
            .reset-icon-main {
                font-size: 32px;
            }
            
            .card-title {
                font-size: 22px;
            }
            
            .card-description {
                font-size: 14px;
            }
            
            .form-input {
                padding: 12px 12px 12px 40px;
                font-size: 15px;
            }
            
            .input-icon {
                font-size: 16px;
            }
            
            .password-requirements {
                padding: 12px;
            }
        }
        
        @media (max-width: 480px) {
            .card-decoration {
                height: 100px;
            }
            
            .reset-icon-container {
                width: 70px;
                height: 70px;
                top: 65px;
            }
            
            .reset-icon-main {
                font-size: 28px;
            }
            
            .card-content {
                padding: 45px 15px 20px;
            }
            
            .card-title {
                font-size: 20px;
            }
            
            .reset-button {
                padding: 12px;
                font-size: 15px;
            }
            
            .requirements-list li {
                font-size: 12px;
            }
        }
    </style>

</x-guest-layout>
