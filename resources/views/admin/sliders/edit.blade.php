@extends('admin.layout')

@section('content')
<style>
    /* Add these styles to your CSS file */
.card {
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
}

/* Image hover effect */
.card img {
  transition: all 0.3s ease;
}

.card img:hover {
  transform: scale(1.02);
}

/* Custom file input styling */
.form-control:focus {
  border-color: #86b7fe;
  box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

/* Responsive adjustments */
@media (max-width: 767.98px) {
  .card-header h5 {
    font-size: 1.1rem;
  }

  .btn {
    width: 100%;
    margin-bottom: 0.5rem;
  }

  .d-md-flex .btn {
    margin-bottom: 0;
  }
}

    </style>
<x-app-layout>
    <main id="main" class="main">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">Sliders</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Image</li>
                        </ol>
                    </nav>

                    <!-- Card -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white py-3">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-edit me-2"></i> Edit Slider Image
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <!-- Current Image Preview -->
                            <div class="text-center mb-4">
                                <div class="position-relative d-inline-block">
                                    <img src="{{ asset($image->image_path) }}" 
                                         alt="Current Slider Image" 
                                         class="img-fluid rounded shadow-sm" 
                                         style="max-height: 250px; max-width: 100%;">
                                    <div class="position-absolute top-0 start-0 bg-dark bg-opacity-50 text-white px-2 py-1 rounded-pill m-2">
                                        <small>Current Image</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Form -->
                            <form action="{{ route('admin.sliders.update', $image->id) }}" 
                                  method="POST" 
                                  enctype="multipart/form-data"
                                  class="needs-validation"
                                  novalidate>
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-4">
                                    <label for="image" class="form-label fw-bold">
                                        <i class="fas fa-image me-1"></i> Select New Image
                                    </label>
                                    <div class="input-group">
                                        <input type="file" 
                                               name="image" 
                                               id="image" 
                                               class="form-control form-control-lg @error('image') is-invalid @enderror"
                                               accept="image/*">
                                        <label class="input-group-text" for="image">Browse</label>
                                    </div>
                                    <div class="form-text text-muted">
                                        Recommended size: 1920×600 pixels. Max file size: 2MB.
                                    </div>
                                </div>

                                <!-- New Image Preview (JavaScript) -->
                                <div id="imagePreview" class="text-center mb-4 d-none">
                                    <h6 class="text-muted mb-2">New Image Preview:</h6>
                                    <img src="/placeholder.svg" alt="New Image Preview" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left me-1"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Update Image
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Display validation errors if any -->
                    @if ($errors->any())
                        <div class="alert alert-danger mt-4 shadow-sm border-0">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-exclamation-circle fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="alert-heading">Please fix the following errors:</h5>
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Display success message if any -->
                    @if(session('success'))
                        <div class="alert alert-success mt-4 shadow-sm border-0">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="alert-heading">Success!</h5>
                                    <p class="mb-0">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript for image preview -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');
            const previewImage = imagePreview.querySelector('img');
            
            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        imagePreview.classList.remove('d-none');
                    }
                    
                    reader.readAsDataURL(this.files[0]);
                } else {
                    imagePreview.classList.add('d-none');
                }
            });
        });
    </script>
</x-app-layout>
@endsection
