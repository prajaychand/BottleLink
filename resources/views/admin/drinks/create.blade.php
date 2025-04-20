@extends('admin.layout')

@section('content')
<style>
    /* Form styling */
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

    .form-control, .form-select {
        border-radius: 0.375rem;
        padding: 0.75rem 1rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    /* Image preview styling */
    #imagePreview {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        overflow: hidden;
        position: relative;
    }

    #imagePreview img {
        max-height: 250px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    #imagePreview img:hover {
        transform: scale(1.05);
    }

    #imagePreview .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }

    /* Alert styling */
    .alert {
        border-radius: 0.5rem;
    }

    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .btn-primary {
            width: 100%;
        }

        .card-header h5 {
            font-size: 1.1rem;
        }
    }

    /* Form sections */
    .form-section {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-section-title {
        font-weight: 600;
        margin-bottom: 1rem;
        color: #495057;
        display: flex;
        align-items: center;
    }

    .form-section-title i {
        margin-right: 0.5rem;
    }

    /* Price input */
    .price-input-group {
        position: relative;
    }

    .price-input-group .form-control {
        padding-left: 3rem;
    }

    .price-input-group .currency-symbol {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 2.5rem;
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-right: none;
        border-top-left-radius: 0.375rem;
        border-bottom-left-radius: 0.375rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #495057;
    }
</style>

<x-app-layout>
    <main id="main" class="main">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.drinks.index') }}">Drinks</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create New Drink</li>
                        </ol>
                    </nav>

                    <!-- Card -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white py-3">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-glass-martini-alt me-2"></i> Create New Drink
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <!-- Form to upload a new drink -->
                            <form action="{{ route('admin.drinks.store') }}" 
                                  method="POST" 
                                  enctype="multipart/form-data"
                                  class="needs-validation"
                                  novalidate>
                                @csrf
                                
                                <!-- Basic Information Section -->
                                <div class="form-section">
                                    <h6 class="form-section-title">
                                        <i class="fas fa-info-circle"></i> Basic Information
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Drink Name</label>
                                            <input type="text" 
                                                   name="name" 
                                                   id="name" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   placeholder="Enter drink name"
                                                   value="{{ old('name') }}"
                                                   required>
                                            <div class="form-text">Enter a descriptive name for the drink.</div>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="category_id" class="form-label">Category</label>
                                            <select name="category_id" 
                                                    id="category_id" 
                                                    class="form-select @error('category_id') is-invalid @enderror"
                                                    required>
                                                <option value="" disabled selected>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="form-text">Choose the category this drink belongs to.</div>
                                            @error('category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="price" class="form-label">Price</label>
                                            <div class="price-input-group">
                                                <div class="currency-symbol">Rs.</div>
                                                <input type="number" 
                                                       name="price" 
                                                       id="price" 
                                                       class="form-control @error('price') is-invalid @enderror" 
                                                       placeholder="0.00"
                                                       step="0.01"
                                                       min="0"
                                                       value="{{ old('price') }}"
                                                       required>
                                            </div>
                                            <div class="form-text">Enter the price in rupees (e.g., 250.00).</div>
                                            @error('price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Description Section -->
                                <div class="form-section">
                                    <h6 class="form-section-title">
                                        <i class="fas fa-align-left"></i> Description
                                    </h6>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Drink Description</label>
                                        <textarea name="description" 
                                                  id="description" 
                                                  class="form-control @error('description') is-invalid @enderror" 
                                                  placeholder="Enter a detailed description of the drink"
                                                  rows="4"
                                                  required>{{ old('description') }}</textarea>
                                        <div class="form-text">Provide a detailed description of the drink, including ingredients and taste profile.</div>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Image Section -->
                                <div class="form-section">
                                    <h6 class="form-section-title">
                                        <i class="fas fa-image"></i> Drink Image
                                    </h6>
                                    <div class="mb-3">
                                        <label for="image_path" class="form-label">Upload Image</label>
                                        <input type="file" 
                                               name="image_path" 
                                               id="image_path" 
                                               class="form-control @error('image_path') is-invalid @enderror"
                                               accept="image/*"
                                               required>
                                        @error('image_path')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <!-- Image Preview -->
                                    <div id="imagePreview" class="mt-3 d-none">
                                        <img src="#" alt="Drink Preview" class="img-fluid rounded">
                                    </div>
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                    <a href="{{ route('admin.drinks.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Create Drink
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
            const imageInput = document.getElementById('image_path');
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
