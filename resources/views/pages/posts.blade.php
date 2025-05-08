@extends('frontend.Master')
@section('content')
<div class="container py-5" style="margin-top:0;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h2 class="mb-4 text-center fw-bold">Create a Post</h2>
            
            <!-- Post Upload Form -->
            <div class="card mb-5 shadow-lg border-0 rounded-4 overflow-hidden hover-card">
                <div class="card-header bg-gradient-primary text-white py-4">
                    <h5 class="mb-0 d-flex align-items-center"><i class="bi bi-pencil-square me-2"></i>Share Your Story</h5>
                </div>
                <div class="card-body p-4 p-lg-5">
                    <form action="{{route('gallery.store')}}" method="POST" enctype="multipart/form-data" id="postForm">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">Post Title</label>
                            <input type="text" class="form-control form-control-lg border-0 bg-light rounded-3" id="title" name="title" placeholder="Enter an engaging title" required>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold">Upload Image</label>
                            <div class="upload-container p-4 rounded-3 bg-light text-center position-relative mb-3" id="uploadContainer">
                                <input type="file" class="form-control d-none" id="image" name="image" accept="image/*">
                                <label for="image" class="upload-label d-block cursor-pointer">
                                    <i class="bi bi-cloud-arrow-up fs-1 text-primary mb-2"></i>
                                    <p class="mb-0">Drag & drop your image here or <span class="text-primary">browse</span></p>
                                    <p class="text-muted small mt-1">Supports: JPG, PNG, GIF (Max 5MB)</p>
                                </label>
                                
                                <!-- Upload Progress Indicator (Initially Hidden) -->
                                <div id="uploadProgress" class="upload-progress d-none">
                                    <div class="progress-ring">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 upload-status">Uploading image...</p>
                                    <div class="progress mt-2" style="height: 10px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
                                             role="progressbar" style="width: 0%" 
                                             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="imagePreview" class="mt-3 d-none">
                                <div class="position-relative d-inline-block">
                                    <img src="/placeholder.svg" class="img-thumbnail rounded-3 shadow-sm" style="max-height: 200px;" alt="Preview">
                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle shadow" id="removeImage" style="margin: -10px;">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                                <div class="mt-2">
                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Image ready to publish</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
                            <button type="reset" class="btn btn-outline-secondary px-4 py-2 rounded-pill">
                                <i class="bi bi-x-circle me-2"></i>Cancel
                            </button>
                            <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill shadow-sm" id="publishBtn">
                                <i class="bi bi-send me-2"></i>Publish Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    /* Custom gradient background for header */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df, #224abe);
    }
    
    /* Card hover effect */
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
    }
    
    /* Form control styling */
    .form-control {
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        border-color: #bac8f3;
        transform: translateY(-2px);
    }
    
    /* Upload container styling */
    .upload-container {
        border: 2px dashed #dee2e6;
        transition: all 0.3s ease;
        min-height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .upload-container:hover {
        border-color: #4e73df;
        background-color: #f8f9ff !important;
    }
    
    .cursor-pointer {
        cursor: pointer;
    }
    
    /* Upload Progress Styling */
    .upload-progress {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.9);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 10;
        border-radius: 0.3rem;
    }
    
    .progress-ring {
        width: 60px;
        height: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .upload-status {
        font-weight: 500;
        color: #4e73df;
    }
    
    /* Button styling */
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #4e73df, #224abe);
        border: none;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.4) !important;
    }
    
    .btn-outline-secondary:hover {
        transform: translateY(-2px);
    }
    
    /* Card image aspect ratio */
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-img-top {
            height: 180px;
        }
        
        .card-body {
            padding: 1.5rem !important;
        }
    }
    
    @media (max-width: 576px) {
        .btn {
            width: 100%;
            margin-top: 0.5rem;
        }
        
        .d-md-flex {
            flex-direction: column-reverse;
        }
        
        .upload-container {
            min-height: 120px;
        }
    }
    
    /* Animation for upload success */
    @keyframes successPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .upload-success {
        animation: successPulse 0.5s ease;
    }
</style>

<!-- JavaScript for Image Preview with Drag & Drop and Upload Progress -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = imagePreview.querySelector('img');
        const removeButton = document.getElementById('removeImage');
        const uploadContainer = document.getElementById('uploadContainer');
        const uploadProgress = document.getElementById('uploadProgress');
        const progressBar = uploadProgress.querySelector('.progress-bar');
        const uploadStatus = uploadProgress.querySelector('.upload-status');
        const postForm = document.getElementById('postForm');
        const publishBtn = document.getElementById('publishBtn');
        
        // File input change handler
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                // Show upload progress
                showUploadProgress();
                
                // Simulate upload progress
                simulateUpload(this.files[0]);
            }
        });
        
        // Remove button handler
        removeButton.addEventListener('click', function() {
            imageInput.value = '';
            imagePreview.classList.add('d-none');
            previewImg.src = '';
            uploadContainer.classList.remove('d-none');
            resetUploadProgress();
        });
        
        // Drag and drop handlers
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadContainer.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadContainer.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            uploadContainer.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            uploadContainer.classList.add('border-primary');
            uploadContainer.style.backgroundColor = '#f8f9ff';
        }
        
        function unhighlight() {
            uploadContainer.classList.remove('border-primary');
            uploadContainer.style.backgroundColor = '';
        }
        
        uploadContainer.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files && files[0]) {
                // Show upload progress
                showUploadProgress();
                
                // Simulate upload progress
                simulateUpload(files[0]);
            }
        }
        
        function showUploadProgress() {
            // Hide the upload label and show progress
            const uploadLabel = uploadContainer.querySelector('.upload-label');
            uploadLabel.style.display = 'none';
            uploadProgress.classList.remove('d-none');
        }
        
        function resetUploadProgress() {
            // Reset progress bar and status
            progressBar.style.width = '0%';
            progressBar.setAttribute('aria-valuenow', '0');
            uploadStatus.textContent = 'Uploading image...';
            
            // Hide progress and show upload label
            uploadProgress.classList.add('d-none');
            const uploadLabel = uploadContainer.querySelector('.upload-label');
            uploadLabel.style.display = 'block';
        }
        
        function simulateUpload(file) {
            // Read file for preview
            const reader = new FileReader();
            
            // Start progress simulation
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 15;
                if (progress > 100) progress = 100;
                
                // Update progress bar
                progressBar.style.width = progress + '%';
                progressBar.setAttribute('aria-valuenow', Math.round(progress));
                
                // Update status text based on progress
                if (progress < 50) {
                    uploadStatus.textContent = 'Uploading image...';
                } else if (progress < 90) {
                    uploadStatus.textContent = 'Processing image...';
                } else {
                    uploadStatus.textContent = 'Finalizing...';
                }
                
                // When complete
                if (progress === 100) {
                    clearInterval(interval);
                    
                    // Wait a moment to show 100% before completing
                    setTimeout(() => {
                        completeUpload(file);
                    }, 500);
                }
            }, 200);
            
            // Set up preview when file is loaded
            reader.onload = function(e) {
                previewImg.src = e.target.result;
            };
            
            reader.readAsDataURL(file);
        }
        
        function completeUpload(file) {
            // Update status
            uploadStatus.textContent = 'Upload complete!';
            uploadStatus.classList.add('text-success');
            
            // Show success animation
            setTimeout(() => {
                // Hide upload container and show preview
                uploadContainer.classList.add('d-none');
                imagePreview.classList.remove('d-none');
                imagePreview.classList.add('upload-success');
                
                // Show success toast
                showToast('Image uploaded successfully!', 'success');
                
                // Reset progress for next upload
                setTimeout(() => {
                    resetUploadProgress();
                    uploadStatus.classList.remove('text-success');
                }, 500);
            }, 600);
        }
        
        // Form submit handler
        postForm.addEventListener('submit', function(e) {
            // Check if image is uploaded
            if (imageInput.value === '') {
                e.preventDefault();
                showToast('Please upload an image for your post', 'warning');
                uploadContainer.classList.add('border-danger');
                setTimeout(() => {
                    uploadContainer.classList.remove('border-danger');
                }, 2000);
            } else {
                // Show submitting state
                publishBtn.disabled = true;
                publishBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Publishing...';
            }
        });
        
        // Simple toast notification
        function showToast(message, type = 'info') {
            // Check if toast container exists, if not create it
            let toastContainer = document.querySelector('.toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
                document.body.appendChild(toastContainer);
            }
            
            // Create toast element
            const toastEl = document.createElement('div');
            let toastType;
            let icon;
            
            switch(type) {
                case 'success':
                    toastType = 'success';
                    icon = 'check-circle';
                    break;
                case 'warning':
                    toastType = 'warning';
                    icon = 'exclamation-triangle';
                    break;
                case 'error':
                    toastType = 'danger';
                    icon = 'x-circle';
                    break;
                default:
                    toastType = 'primary';
                    icon = 'info-circle';
            }
            
            toastEl.className = `toast align-items-center text-white bg-${toastType} border-0`;
            toastEl.setAttribute('role', 'alert');
            toastEl.setAttribute('aria-live', 'assertive');
            toastEl.setAttribute('aria-atomic', 'true');
            
            // Toast content
            toastEl.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi bi-${icon} me-2"></i>
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;
            
            // Add to container
            toastContainer.appendChild(toastEl);
            
            // Initialize and show toast
            const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
            toast.show();
            
            // Remove after hiding
            toastEl.addEventListener('hidden.bs.toast', function() {
                toastEl.remove();
            });
        }
    });
</script>
@endsection