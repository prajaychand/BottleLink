@extends('admin.layout')

@section('content')
<style>
    /* Add these styles to your CSS file */
.hover-shadow {
  transition: all 0.3s ease;
}

.hover-shadow:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
}

.card {
  border-radius: 0.5rem;
  overflow: hidden;
}

.card-img-top {
  transition: all 0.3s ease;
}

.card:hover .card-img-top {
  transform: scale(1.05);
}

.badge {
  font-weight: 500;
  padding: 0.5rem 0.75rem;
}

/* Search input styling */
.input-group {
  max-width: 300px;
}

@media (max-width: 767.98px) {
  .input-group {
    max-width: 100%;
    margin-bottom: 1rem;
  }

  .d-flex.gap-2 {
    width: 100%;
  }

  .btn-primary {
    width: 100%;
  }

  /* Hide the grid view on mobile */
  .category-item {
    display: none;
  }
}

@media (min-width: 768px) {
  /* Hide the list view on desktop */
  .d-md-none {
    display: none !important;
  }

  /* Show the grid view on desktop */
  .category-item {
    display: block;
  }
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

</style>
    <x-app-layout>
        <main id="main" class="main">
            <div class="container py-5">
                <!-- Header Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h1 class="fw-bold text-primary mb-0">Categories</h1>
                                <p class="text-muted">Manage your product categories</p>
                            </div>
                            <div class="d-flex gap-2 flex-wrap">
                                <div class="input-group">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Search categories...">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <a href="{{ route('admin.category.create') }}" class="btn btn-primary d-flex align-items-center">
                                    <i class="fas fa-plus-circle me-2"></i> Create New Category
                                </a>
                            </div>
                        </div>
                        <hr class="my-4">
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-12 col-md-4 mb-3">
                        <div class="card border-0 bg-primary bg-opacity-10 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle bg-primary text-white p-3 me-3">
                                    <i class="fas fa-folder fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">{{ count($categories) }}</h3>
                                    <p class="text-muted mb-0">Total Categories</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <div class="card border-0 bg-success bg-opacity-10 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle bg-success text-white p-3 me-3">
                                    <i class="fas fa-image fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">{{ $categories->whereNotNull('image_path')->count() }}</h3>
                                    <p class="text-muted mb-0">With Images</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <div class="card border-0 bg-info bg-opacity-10 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="rounded-circle bg-info text-white p-3 me-3">
                                    <i class="fas fa-eye fa-2x"></i>
                                </div>
                                <div>
                                    <h3 class="mb-0">Active</h3>
                                    <p class="text-muted mb-0">Status</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categories Grid -->
                <div class="row" id="categoriesContainer">
                    @if(count($categories) > 0)
                        @foreach($categories as $item)
                            <div class="col-12 col-md-6 col-lg-4 mb-4 category-item">
                                <div class="card h-100 border-0 shadow-sm hover-shadow">
                                    <div class="position-relative">
                                        @if($item->image_path)
                                            <img src="{{ asset('storage/' . $item->image_path) }}" 
                                                alt="{{ $item->name }}" 
                                                class="card-img-top" 
                                                style="height: 200px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                style="height: 200px;">
                                                <i class="fas fa-image fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="position-absolute top-0 end-0 p-2">
                                            <span class="badge bg-primary rounded-pill">
                                                <i class="fas fa-tag me-1"></i> Category
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold text-truncate">{{ $item->name }}</h5>
                                        <p class="card-text text-muted small">
                                            <i class="fas fa-calendar-alt me-1"></i> Created: {{ $item->created_at->format('M d, Y') }}
                                        </p>
                                    </div>
                                    <div class="card-footer bg-white border-0">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('admin.category.edit', $item->id) }}" 
                                                class="btn btn-outline-primary">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-outline-danger delete-btn" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $item->id }}">
                                                <i class="fas fa-trash me-1"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Confirm Delete</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete the category <strong>{{ $item->name }}</strong>?</p>
                                            <p class="text-danger"><i class="fas fa-exclamation-triangle me-1"></i> This action cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('admin.category.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete Category</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="alert alert-info text-center py-5">
                                <i class="fas fa-info-circle fa-3x mb-3"></i>
                                <h4>No Categories Found</h4>
                                <p>You haven't created any categories yet.</p>
                                <a href="{{ route('admin.category.create') }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-plus-circle me-1"></i> Create Your First Category
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Responsive Table View for Mobile -->
                <div class="d-md-none mt-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Categories List</h5>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($categories as $item)
                                <div class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        @if($item->image_path)
                                            <img src="{{ asset('storage/' . $item->image_path) }}" 
                                                alt="{{ $item->name }}" 
                                                class="rounded me-3" 
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center me-3" 
                                                style="width: 50px; height: 50px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0">{{ $item->name }}</h6>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.category.edit', $item->id) }}">
                                                        <i class="fas fa-edit me-1"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item text-danger mobile-delete-btn" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#deleteModal{{ $item->id }}">
                                                        <i class="fas fa-trash me-1"></i> Delete
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- JavaScript for search functionality and modal initialization -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Search functionality
                const searchInput = document.getElementById('searchInput');
                const categoriesContainer = document.getElementById('categoriesContainer');
                const categoryItems = document.querySelectorAll('.category-item');
                
                searchInput.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase();
                    
                    categoryItems.forEach(item => {
                        const categoryName = item.querySelector('.card-title').textContent.toLowerCase();
                        
                        if (categoryName.includes(searchTerm)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                    
                    // Check if no results
                    const visibleItems = [...categoryItems].filter(item => item.style.display !== 'none');
                    
                    if (visibleItems.length === 0 && searchTerm !== '') {
                        // If no existing "no results" message, create one
                        if (!document.getElementById('noResults')) {
                            const noResults = document.createElement('div');
                            noResults.id = 'noResults';
                            noResults.className = 'col-12';
                            noResults.innerHTML = `
                                <div class="alert alert-info text-center py-4">
                                    <i class="fas fa-search fa-2x mb-3"></i>
                                    <h5>No matching categories found</h5>
                                    <p>Try a different search term</p>
                                </div>
                            `;
                            categoriesContainer.appendChild(noResults);
                        }
                    } else {
                        // Remove "no results" message if it exists
                        const noResults = document.getElementById('noResults');
                        if (noResults) {
                            noResults.remove();
                        }
                    }
                });

                // Modal initialization for delete buttons
                const deleteButtons = document.querySelectorAll('.delete-btn, .mobile-delete-btn');
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const target = this.getAttribute('data-bs-target');
                        const modal = new bootstrap.Modal(document.querySelector(target));
                        modal.show();
                    });
                });
            });
        </script>
    </x-app-layout>
@endsection
