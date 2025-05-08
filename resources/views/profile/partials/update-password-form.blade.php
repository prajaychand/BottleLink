<section class="card border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-header bg-primary text-white p-4">
        <div class="d-flex align-items-center">
            <i class="bi bi-shield-lock fs-3 me-3"></i>
            <div>
                <h2 class="fs-4 fw-bold mb-1">
                    {{ __('Update Password') }}
                </h2>
                <p class="mb-0 opacity-75 small">
                    {{ __('Ensure your account is using a long, random password to stay secure.') }}
                </p>
            </div>
        </div>
    </div>

    <div class="card-body p-4">
        <form method="post" action="{{ route('password.update') }}" class="mt-3">
            @csrf
            @method('put')

            <div class="mb-4">
                <label for="update_password_current_password" class="form-label fw-semibold">{{ __('Current Password') }}</label>
                <div class="input-group">
                    <span class="input-group-text bg-light">
                        <i class="bi bi-key"></i>
                    </span>
                    <input 
                        id="update_password_current_password" 
                        name="current_password" 
                        type="password" 
                        class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                        autocomplete="current-password"
                        placeholder="Enter your current password"
                    >
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('update_password_current_password')">
                        <i class="bi bi-eye"></i>
                    </button>
                    @error('current_password', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="update_password_password" class="form-label fw-semibold">{{ __('New Password') }}</label>
                <div class="input-group">
                    <span class="input-group-text bg-light">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input 
                        id="update_password_password" 
                        name="password" 
                        type="password" 
                        class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                        autocomplete="new-password"
                        placeholder="Enter your new password"
                        onkeyup="checkPasswordStrength(this.value)"
                    >
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('update_password_password')">
                        <i class="bi bi-eye"></i>
                    </button>
                    @error('password', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <div class="password-strength-meter d-flex mt-2">
                        <div id="strength-1" class="strength-segment bg-secondary opacity-25"></div>
                        <div id="strength-2" class="strength-segment bg-secondary opacity-25"></div>
                        <div id="strength-3" class="strength-segment bg-secondary opacity-25"></div>
                        <div id="strength-4" class="strength-segment bg-secondary opacity-25"></div>
                    </div>
                    <small id="password-strength-text" class="form-text text-muted">Password strength: Not entered</small>
                </div>
            </div>

            <div class="mb-4">
                <label for="update_password_password_confirmation" class="form-label fw-semibold">{{ __('Confirm Password') }}</label>
                <div class="input-group">
                    <span class="input-group-text bg-light">
                        <i class="bi bi-check-circle"></i>
                    </span>
                    <input 
                        id="update_password_password_confirmation" 
                        name="password_confirmation" 
                        type="password" 
                        class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" 
                        autocomplete="new-password"
                        placeholder="Confirm your new password"
                    >
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('update_password_password_confirmation')">
                        <i class="bi bi-eye"></i>
                    </button>
                    @error('password_confirmation', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="alert alert-info d-flex align-items-center" role="alert">
                <i class="bi bi-info-circle-fill me-2"></i>
                <div>
                    <strong>Password tips:</strong>
                    <ul class="mb-0 ps-3 mt-1">
                        <li>Use at least 8 characters</li>
                        <li>Include uppercase and lowercase letters</li>
                        <li>Add numbers and special characters</li>
                        <li>Avoid using personal information</li>
                    </ul>
                </div>
            </div>

            <div class="d-flex align-items-center mt-4">
                <button type="submit" class="btn btn-primary px-4 py-2 d-flex align-items-center">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ __('Update Password') }}
                </button>

                @if (session('status') === 'password-updated')
                    <div class="ms-3 fade show alert alert-success py-1 px-2 mb-0 d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        <span>{{ __('Password updated!') }}</span>
                    </div>
                @endif
            </div>
        </form>
    </div>
</section>

<style>
.strength-segment {
    height: 5px;
    flex: 1;
    margin-right: 3px;
    border-radius: 2px;
}
.strength-segment:last-child {
    margin-right: 0;
}
</style>

<script>
function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}

function checkPasswordStrength(password) {
    const strengthText = document.getElementById('password-strength-text');
    const strength1 = document.getElementById('strength-1');
    const strength2 = document.getElementById('strength-2');
    const strength3 = document.getElementById('strength-3');
    const strength4 = document.getElementById('strength-4');
    
    // Reset all segments
    [strength1, strength2, strength3, strength4].forEach(segment => {
        segment.className = 'strength-segment bg-secondary opacity-25';
    });
    
    if (!password) {
        strengthText.textContent = 'Password strength: Not entered';
        return;
    }
    
    let strength = 0;
    
    // Length check
    if (password.length >= 8) strength++;
    
    // Character variety checks
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;
    
    // Update the strength meter
    if (strength >= 1) {
        strength1.className = 'strength-segment bg-danger';
    }
    if (strength >= 2) {
        strength2.className = 'strength-segment bg-warning';
    }
    if (strength >= 3) {
        strength3.className = 'strength-segment bg-info';
    }
    if (strength >= 4) {
        strength4.className = 'strength-segment bg-success';
    }
    
    // Update the strength text
    const strengthLabels = ['Very weak', 'Weak', 'Medium', 'Strong', 'Very strong'];
    strengthText.textContent = `Password strength: ${strengthLabels[strength]}`;
}
</script>