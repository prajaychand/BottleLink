@extends('frontend.Master')
@section('content')

<style>
:root {
    --primary-color: #000000;
    --primary-light: #020103;
    --primary-dark: #000000;
    --secondary-color: #03dac6;
    --secondary-dark: #018786;
    --background-light: #f8f9fa;
    --text-primary: #333333;
    --text-secondary: #666666;
    --success-color: #00c853;
    --warning-color: #ffab00;
    --danger-color: #f44336;
    --border-radius: 12px;
    --box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
}

body {
    background-color: var(--background-light);
}

.page-header {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    padding: 60px 0 100px;
    margin-bottom: -70px;
    color: white;
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    z-index: 0;
}

.page-header::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -5%;
    width: 250px;
    height: 250px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.08);
    z-index: 0;
}

.page-header-content {
    position: relative;
    z-index: 1;
}

.profile-container {
    position: relative;
    z-index: 2;
}

.profile-card {
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    border: none;
    border-radius: var(--border-radius);
    overflow: hidden;
}

.profile-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

.card-header-gradient {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    color: white;
    border-bottom: none;
    position: relative;
    overflow: hidden;
}

.card-header-gradient::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    z-index: 0;
}

.card-header-content {
    position: relative;
    z-index: 1;
}

.form-control {
    padding: 0.75rem 1rem;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    background-color: #f9fafc;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(98, 0, 234, 0.15);
    background-color: #ffffff;
}

.input-group-text {
    border-radius: 8px 0 0 8px;
    background-color: #f0f0f0;
    border: 1px solid #e0e0e0;
    border-right: none;
}

.btn-purple {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    border: none;
    color: white;
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-purple:hover {
    background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(98, 0, 234, 0.3);
}

.btn-outline-purple {
    color: var(--primary-color);
    border: 1px solid var(--primary-color);
    background-color: transparent;
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-outline-purple:hover {
    background-color: var(--primary-color);
    color: white;
}

.nav-pills .nav-link {
    color: var(--text-secondary);
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
}

.nav-pills .nav-link:hover {
    background-color: rgba(98, 0, 234, 0.05);
}

.nav-pills .nav-link.active {
    background-color: var(--primary-color);
    color: white;
}

.nav-pills .nav-link i {
    margin-right: 0.5rem;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid white;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.avatar-upload {
    position: relative;
    display: inline-block;
}

.avatar-edit {
    position: absolute;
    right: 5px;
    bottom: 5px;
    width: 36px;
    height: 36px;
    background-color: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
}

.avatar-edit:hover {
    background-color: var(--primary-dark);
    transform: scale(1.1);
}

.avatar-edit input {
    display: none;
}

.progress-bar {
    background-color: var(--primary-color);
}

.alert {
    border-radius: 8px;
    border: none;
}

.alert-success {
    background-color: rgba(0, 200, 83, 0.1);
    color: var(--success-color);
}

.alert-success i {
    color: var(--success-color);
}

.badge-premium {
    background: linear-gradient(135deg, #ff9800, #ff5722);
    color: white;
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
}

.activity-item {
    padding: 1rem;
    border-radius: 8px;
    background-color: #f9fafc;
    margin-bottom: 0.75rem;
    transition: all 0.3s ease;
}

.activity-item:hover {
    background-color: #f0f2f5;
    transform: translateX(5px);
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 1rem;
}

.activity-icon.bg-login {
    background-color: var(--primary-color);
}

.activity-icon.bg-update {
    background-color: var(--secondary-color);
}

.activity-time {
    font-size: 0.8rem;
    color: var(--text-secondary);
}

/* Animation classes */
.fade-in {
    animation: fadeIn 0.5s ease-out forwards;
}

.slide-up {
    animation: slideUp 0.5s ease-out forwards;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .page-header {
        padding: 40px 0 80px;
        margin-bottom: -50px;
    }
    
    .profile-sidebar {
        margin-bottom: 2rem;
    }
}

@media (max-width: 768px) {
    .page-header {
        padding: 30px 0 70px;
    }
    
    .profile-avatar {
        width: 100px;
        height: 100px;
    }
}
</style>


<div class="container profile-container py-4">
    <div class="row g-4">
        <!-- Sidebar -->
        <div class="col-lg-3 profile-sidebar">
            <div class="card profile-card shadow-sm mb-4">
                <div class="card-body text-center p-4">
                    <!-- Avatar -->
                    <div class="avatar-upload mb-3 position-relative">
                        <img 
                        src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=00000000&color=fff' }}" 
                        alt="Profile Avatar" 
                        class="profile-avatar mb-3 rounded-circle" 
                        style="width: 100px; height: 100px; object-fit: cover; background-color: #000;"
                    >
                    
                        <label for="avatar-upload" class="avatar-edit position-absolute top-0 end-0">
                            <i class="bi bi-camera"></i>
                            <input type="file" id="avatar-upload" accept="image/*" class="d-none">
                        </label>
                    </div>
        
                    <!-- Name and Email -->
                    <h5 class="fw-bold mb-1">{{ auth()->user()->name }}</h5>
                    <p class="text-muted mb-2">{{ auth()->user()->email }}</p>
                </div>
            </div>
        
            <!-- Navigation Tabs -->
            <div class="card profile-card shadow-sm">
                <div class="card-body p-3">
                    <nav class="nav flex-column nav-pills">
                        <a class="nav-link active" href="#profile-tab" data-bs-toggle="tab">
                            <i class="bi bi-person"></i> Profile Information
                        </a>
                        <a class="nav-link" href="#security-tab" data-bs-toggle="tab">
                            <i class="bi bi-shield-lock"></i> Security Settings
                        </a>    
                    </nav>
                </div>
            </div>
        </div>
        
        
        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="tab-content">
                <!-- Profile Tab -->
                <div class="tab-pane fade show active" id="profile-tab">
                    <div class="card profile-card shadow-sm">
                        <div class="card-header card-header-gradient py-3">
                            <div class="d-flex align-items-center card-header-content">
                                <i class="bi bi-person-circle fs-4 me-2"></i>
                                <div>
                                    <h5 class="card-title mb-0 fw-bold">Profile Information</h5>
                                    <p class="card-subtitle mb-0 small opacity-75">Update your personal details</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <!-- Success message example -->
                            @if(session('status') === 'profile-updated')
                            <div class="alert alert-success d-flex align-items-center slide-up" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <div>Your profile information has been updated successfully.</div>
                            </div>
                            @endif
                            
                            
                            <!-- Profile form -->
<!-- Profile form -->
<div class="profile-form fade-in">
    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="row g-3">
            <!-- Full Name -->
            <div class="col-md-6">
                <label for="name" class="form-label">Full Name</label>
                <div class="input-group mb-1">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{ old('name', auth()->user()->name) }}" placeholder="Enter your full name">
                </div>
                @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group mb-1">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email"
                           value="{{ old('email', auth()->user()->email) }}" placeholder="Enter your email">
                </div>
                @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone -->
            <div class="col-md-6">
                <label for="phone" class="form-label">Phone Number</label>
                <div class="input-group mb-1">
                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                    <input type="tel" class="form-control" id="phone" name="phone"
                           value="{{ old('phone', auth()->user()->phone) }}" placeholder="Enter your phone number">
                </div>
                @error('phone')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Gender -->
            <div class="col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <div class="input-group mb-1">
                    <span class="input-group-text"><i class="bi bi-gender-ambiguous"></i></span>
                    <select id="gender" name="gender" class="form-control">
                        <option value="male" {{ old('gender', auth()->user()->gender) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', auth()->user()->gender) == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender', auth()->user()->gender) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                @error('gender')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-light me-2">Cancel</button>
            <button type="submit" class="btn btn-purple">
                <i class="bi bi-check-circle me-1"></i> Save Changes
            </button>
        </div>
    </form>
</div>

    
</div>

                        </div>
                    </div>
                </div>
                
                <!-- Security Tab -->
                <div class="tab-pane fade" id="security-tab">
                    <div class="card profile-card shadow-sm">
                        <div class="card-header card-header-gradient py-3">
                            <div class="d-flex align-items-center card-header-content">
                                <i class="bi bi-shield-lock fs-4 me-2"></i>
                                <div>
                                    <h5 class="card-title mb-0 fw-bold">Security Settings</h5>
                                    <p class="card-subtitle mb-0 small opacity-75">Manage your password and security</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <!-- Success message example -->
                            @if(session('status') === 'password-updated')
                            <div class="alert alert-success d-flex align-items-center slide-up" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <div>Your password has been updated successfully.</div>
                            </div>
                            @endif
                            
                            <!-- Security form -->
                            <div class="profile-form fade-in">
                                <form method="post" action="{{ route('password.update') }}">
                                    @csrf
                                    @method('put')
                                    
                                    <div class="mb-4">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter your current password">
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('current_password')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="password" class="form-label">New Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your new password" onkeyup="checkPasswordStrength(this.value)">
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('password')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        
                                        <div class="mt-2">
                                            <div class="d-flex mt-2 mb-1">
                                                <div id="strength-1" class="bg-secondary opacity-25 me-1 rounded" style="height: 5px; flex: 1;"></div>
                                                <div id="strength-2" class="bg-secondary opacity-25 me-1 rounded" style="height: 5px; flex: 1;"></div>
                                                <div id="strength-3" class="bg-secondary opacity-25 me-1 rounded" style="height: 5px; flex: 1;"></div>
                                                <div id="strength-4" class="bg-secondary opacity-25 rounded" style="height: 5px; flex: 1;"></div>
                                            </div>
                                            <small id="password-strength-text" class="text-muted">Password strength: Not entered</small>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-check-circle"></i></span>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your new password">
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('password_confirmation')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="button" class="btn btn-light me-2">Cancel</button>
                                        <button type="submit" class="btn btn-purple">
                                            <i class="bi bi-shield-check me-1"></i> Update Password
                                        </button>
                                    </div>
                                </form>
                                
                                <hr class="my-4">
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Script for password visibility toggle and strength meter -->
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
        segment.className = 'bg-secondary opacity-25 me-1 rounded';
        segment.style.height = '5px';
        segment.style.flex = '1';
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
    const strengthClasses = ['bg-danger', 'bg-warning', 'bg-info', 'bg-success'];
    const strengthLabels = ['Very weak', 'Weak', 'Medium', 'Strong', 'Very strong'];
    
    for (let i = 0; i < strength; i++) {
        const segment = [strength1, strength2, strength3, strength4][i];
        segment.className = `${strengthClasses[i]} me-1 rounded`;
        segment.style.height = '5px';
        segment.style.flex = '1';
    }
    
    strengthText.textContent = `Password strength: ${strengthLabels[strength]}`;
}

// Initialize Bootstrap tabs
document.addEventListener('DOMContentLoaded', function() {
    // Enable Bootstrap tabs
    const triggerTabList = [].slice.call(document.querySelectorAll('.nav-link'));
    triggerTabList.forEach(function(triggerEl) {
        triggerEl.addEventListener('click', function(event) {
            event.preventDefault();
            const tabTrigger = new bootstrap.Tab(triggerEl);
            tabTrigger.show();
        });
    });
    
    // File upload preview
    const avatarUpload = document.getElementById('avatar-upload');
    if (avatarUpload) {
        avatarUpload.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const profileAvatar = document.querySelector('.profile-avatar');
                    profileAvatar.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
@endsection