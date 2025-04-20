<section class="card border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-header bg-primary text-white p-4">
        <div class="d-flex align-items-center">
            <i class="bi bi-person-badge fs-3 me-3"></i>
            <div>
                <h2 class="fs-4 fw-bold mb-1">
                    {{ __('Profile Information') }}
                </h2>
                <p class="mb-0 opacity-75 small">
                    {{ __("Update your account's profile information and email address.") }}
                </p>
            </div>
        </div>
    </div>

    <div class="card-body p-4">
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="mt-3">
            @csrf
            @method('patch')

            <div class="mb-4">
                <label for="name" class="form-label fw-semibold">{{ __('Name') }}</label>
                <div class="input-group">
                    <span class="input-group-text bg-light">
                        <i class="bi bi-person"></i>
                    </span>
                    <input 
                        id="name" 
                        name="name" 
                        type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        value="{{ old('name', $user->name) }}" 
                        required 
                        autofocus 
                        autocomplete="name"
                        placeholder="Enter your full name"
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-text">Your display name visible to other users</div>
            </div>

            <div class="mb-4">
                <label for="email" class="form-label fw-semibold">{{ __('Email') }}</label>
                <div class="input-group">
                    <span class="input-group-text bg-light">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        value="{{ old('email', $user->email) }}" 
                        required 
                        autocomplete="username"
                        placeholder="your.email@example.com"
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="alert alert-warning d-flex align-items-center mt-3" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <div>
                            {{ __('Your email address is unverified.') }}
                            
                            <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline text-decoration-none">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </div>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success d-flex align-items-center mt-3" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <div>
                                {{ __('A new verification link has been sent to your email address.') }}
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            <div class="d-flex align-items-center mt-4">
                <button type="submit" class="btn btn-primary px-4 py-2 d-flex align-items-center">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ __('Save Changes') }}
                </button>

                @if (session('status') === 'profile-updated')
                    <div class="ms-3 fade show alert alert-success py-1 px-2 mb-0 d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        <span>{{ __('Saved successfully!') }}</span>
                    </div>
                @endif
            </div>
        </form>
    </div>
</section>