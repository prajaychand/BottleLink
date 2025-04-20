@extends('admin.layout')

@section('content')
<style>
    /* Add these styles to your CSS file */
.card {
  transition: all 0.3s ease;
  border-radius: 0.5rem;
  overflow: hidden;
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

/* Image preview styling */
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

/* Danger zone styling */
.card.border-danger {
  border-width: 1px;
}

.card.border-danger .card-header {
  font-weight: 600;
}

/* Modal styling */
.modal-content {
  border-radius: 0.5rem;
  border: none;
  overflow: hidden;
}

.modal-header {
  border-bottom: none;
}

.modal-footer {
  border-top: none;
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
                                <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                            </ol>
                        </nav>

                        <!-- Card -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary text-white py-3">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-edit me-2"></i> Edit Category: {{ $category->name }}
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <!-- Current Image Preview -->
                                @if($category->image_path)
                                    <div class="text-center mb-4">
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset('storage/' . $category->image_path) }}" 
                                                alt="{{ $category->name }}" 
                                                class="img-fluid rounded shadow-sm" 
                                                style="max-height: 200px; max-width: 100%;">
                                            <div class="position-absolute top-0 start-0 bg-dark bg-opacity-50 text-white px-2 py-1 rounded-pill m-2">
                                                <small>Current Image</small>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-info mb-4">
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <i class="fas fa-info-circle fa-2x"></i>
                                            </div>
                                            <div>
                                                <h6 class="alert-heading">No Image Available</h6>
                                                <p class="mb-0">Upload an image to enhance your category.</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Form -->
                                <form action="{{ route('admin.category.update', $category->id) }}" 
                                      method="POST" 
                                      enctype="multipart/form-data"
                                      class="needs-validation"
                                      novalidate>
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="mb-4">
                                        <label for="name" class="form-label fw-bold">
                                            <i class="fas fa-tag me-1"></i> Category Name
                                        </label>
                                        <input type="text" 
                                               name="name" 
                                               id="name" 
                                               class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                               value="{{ old('name', $category->name) }}"
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
                                            <i class="fas fa-image me-1"></i> Update Category Image
                                        </label>
                                        <div class="input-group mb-3">
                                            <input type="file" 
                                                   name="image" 
                                                   id="image" 
                                                   class="form-control form-control-lg @error('image') is-invalid @enderror"
                                                   accept="image/*">
                                            <label class="input-group-text" for="image">
                                                <i class="fas fa-upload"></i>
                                            </label>
                                        </div>
                                        <div class="form-text">
                                            Leave empty to keep the current image. Recommended size: 800×600 pixels.
                                        </div>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- New Image Preview -->
                                    <div id="imagePreview" class="text-center mb-4 d-none">
                                        <div class="card bg-light border-0">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">New Image Preview</h6>
                                            </div>
                                            <div class="card-body">
                                                <img src="/placeholder.svg" alt="New Image Preview" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                        <a href="{{ route('admin.category.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-arrow-left me-1"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> Update Category
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>


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
