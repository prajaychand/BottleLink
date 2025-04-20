@extends('admin.layout')

@section('content')
<style>
    /* Add these styles to your CSS file */
.hover-shadow:hover {
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.transition-all {
  transition: all 0.3s ease;
}

/* Responsive adjustments */
@media (max-width: 767.98px) {
  .card-img-top {
    height: 150px !important;
  }
}

/* Hide table on larger screens */
@media (min-width: 768px) {
  .d-md-none {
    display: none !important;
  }
}

    </style>
<x-app-layout>
    <main id="main" class="main">
        <div class="container py-5">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h1 class="fw-bold text-primary mb-3 mb-md-0">Slider Images</h1>
                        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary d-flex align-items-center">
                            <i class="fas fa-plus-circle me-2"></i> Create New Slider
                        </a>
                    </div>
                    <hr class="my-4">
                </div>
            </div>

            <div class="row">
                @if(count($images) > 0)
                    @foreach($images as $image)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm border-0 hover-shadow transition-all">
                            <div class="position-relative">
                                <img src="{{ asset($image->image_path) }}" alt="Slider Image" 
                                    class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">
                                <div class="position-absolute top-0 end-0 p-2">
                                    <span class="badge bg-primary">Slider #{{ $loop->iteration }}</span>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mt-auto pt-3">
                                    <a href="{{ route('admin.sliders.edit', $image->id) }}" 
                                        class="btn btn-outline-primary btn-sm d-flex align-items-center">
                                        <i class="fas fa-edit me-2"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.sliders.destroy', $image->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center"
                                            onclick="return confirm('Are you sure you want to delete this slider?')">
                                            <i class="fas fa-trash me-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-info text-center py-4">
                            <i class="fas fa-info-circle fa-2x mb-3"></i>
                            <p class="mb-0">No slider images found. Click "Create New Slider" to add your first image.</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Responsive fallback for very small screens -->
            <div class="d-md-none mt-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($images as $image)
                            <tr>
                                <td class="align-middle">
                                    <img src="{{ asset($image->image_path) }}" alt="Slider Image" 
                                        class="img-thumbnail" width="80">
                                </td>
                                <td class="align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.sliders.edit', $image->id) }}" 
                                            class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.sliders.destroy', $image->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
@endsection
