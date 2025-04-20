@extends('admin.layout')

@section('content')
<style>
    /* Add these styles to your CSS file */
.card {
  transition: all 0.3s ease;
  border-radius: 0.5rem;
}

.card:hover {
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
}

.card-header {
  border-top-left-radius: 0.5rem !important;
  border-top-right-radius: 0.5rem !important;
}

/* Form styling */
.form-control {
  border-radius: 0.375rem;
}

.form-control:focus {
  border-color: #86b7fe;
  box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.form-control-lg {
  font-size: 1rem;
}

/* Image preview card */
#imagePreview .card {
  overflow: hidden;
  background-color: #f8f9fa;
}

#imagePreview img {
  transition: transform 0.3s ease;
}

#imagePreview img:hover {
  transform: scale(1.05);
}

/* Alert styling */
.alert {
  border-radius: 0.5rem;
}

/* Responsive adjustments */
@media (max-width: 767.98px) {
  .btn {
    width: 100%;
    margin-bottom: 0.5rem;
  }

  .d-md-flex .btn {
    margin-bottom: 0;
  }

  .card-header h5 {
    font-size: 1.1rem;
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
                                <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Categories</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create New</li>
                            </ol>
                        </nav>

                        <!-- Card -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary text-white py-3">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-folder-plus me-2"></i> Create New Category
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <!-- Form to upload a new category with image -->
                                <form action="{{ route('admin.category.store') }}" 
                                      method="POST" 
                                      enctype="multipart/form-data"
                                      class="needs-validation"
                                      novalidate>
                                    @csrf
                                    
                                    <div class="mb-4">
                                        <label for="name" class="form-label fw-bold">
                                            <i class="fas fa-tag me-1"></i> Category Name
                                        </label>
                                        <input type="text" 
                                               name="name" 
                                               id="name" 
                                               class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                               placeholder="Enter category name"
                                               value="{{ old('name') }}"
                                               required>
                                        <div class="form-text">
                                            Choose a descriptive name for your category.
                                        </div>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="image" class="form-label fw-bold">
                                            <i class="fas fa-image me-1"></i> Category Image
                                        </label>
                                        <div class="input-group mb-3">
                                            <input type="file" 
                                                   name="image" 
                                                   id="image" 
                                                   class="form-control form-control-lg @error('image') is-invalid @enderror"
                                                   accept="image/*"
                                                   required>
                                            <label class="input-group-text" for="image">
                                                <i class="fas fa-upload"></i>
                                            </label>
                                        </div>
                                        <div class="form-text">
                                            Recommended size: 800×600 pixels. Max file size: 2MB.
                                        </div>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Image Preview -->
                                    <div id="imagePreview" class="text-center mb-4 d-none">
                                        <div class="card bg-light border-0">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">Image Preview</h6>
                                            </div>
                                            <div class="card-body">
                                                <img src="/placeholder.svg" alt="Category Image Preview" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                        <a href="{{ route('admin.category.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-1"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> Create Category
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
                                        <i class="fas fa-exclamation-triangle fa-2x"></i>
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

                        <!-- Display success message after successful upload -->
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
