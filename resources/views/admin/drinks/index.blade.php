@extends('admin.layout')

@section('content')
<style>
    /* Drink list styling */
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
        height: 200px;
        object-fit: cover;
        transition: all 0.3s ease;
    }

    .card:hover .card-img-top {
        transform: scale(1.05);
    }

    .badge {
        font-weight: 500;
        padding: 0.5rem 0.75rem;
    }

    .price-badge {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: bold;
    }

    .category-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 10;
    }

    .drink-description {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Search and filter styling */
    .search-container {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .input-group {
        max-width: 100%;
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
        .d-flex.gap-2 {
            width: 100%;
        }

        .btn-primary {
            width: 100%;
            margin-top: 1rem;
        }

        .search-container {
            padding: 1rem;
        }

        .card-img-top {
            height: 150px;
        }
    }

    /* List view for mobile */
    .list-view-item {
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        overflow: hidden;
    }

    .list-view-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
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
                                <h1 class="fw-bold text-primary mb-0">Drinks Menu</h1>
                                <p class="text-muted">Manage your drink offerings</p>
                            </div>
                            <a href="{{ route('admin.drinks.create') }}" class="btn btn-primary d-flex align-items-center">
                                <i class="fas fa-plus-circle me-2"></i> Create New Drink
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Search and Filter Section -->
                <div class="search-container">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="input-group">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search drinks...">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <select id="categoryFilter" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($drinks->pluck('category.name')->unique() as $category)
                                    @if($category)
                                        <option value="{{ $category }}">{{ $category }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-3">
                            <select id="priceSort" class="form-select">
                                <option value="">Sort by Price</option>
                                <option value="low-high">Price: Low to High</option>
                                <option value="high-low">Price: High to Low</option>
                            </select>
                        </div>
                    </div>
                </div>


                </div>

                <!-- Drinks Grid View (for tablets and desktops) -->
                <div class="row d-none d-md-flex" id="drinksContainer">
                    @if(count($drinks) > 0)
                        @foreach($drinks as $drink)
                            <div class="col-md-6 col-lg-4 mb-4 drink-item" 
                                 data-name="{{ strtolower($drink->name) }}" 
                                 data-category="{{ strtolower($drink->category->name ?? '') }}"
                                 data-price="{{ $drink->price }}">
                                <div class="card h-100 border-0 shadow-sm hover-shadow">
                                    <div class="position-relative">
                                        <img src="{{ asset($drink->image_path) }}" 
                                             alt="{{ $drink->name }}" 
                                             class="card-img-top">
                                        
                                        <div class="category-badge">
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $drink->category->name ?? 'Uncategorized' }}
                                            </span>
                                        </div>
                                        
                                        <div class="price-badge">
                                            <span>Rs.{{ number_format($drink->price, 2) }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">{{ $drink->name }}</h5>
                                        <p class="card-text text-muted drink-description">{{ $drink->description }}</p>
                                    </div>
                                    <div class="card-footer bg-white border-0">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('admin.drinks.edit', $drink->id) }}" 
                                               class="btn btn-outline-primary">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-outline-danger delete-btn" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $drink->id }}">
                                                <i class="fas fa-trash me-1"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $drink->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $drink->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $drink->id }}">Confirm Delete</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete <strong>{{ $drink->name }}</strong>?</p>
                                            <p class="text-danger"><i class="fas fa-exclamation-triangle me-1"></i> This action cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('admin.drinks.destroy', $drink->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete Drink</button>
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
                                <h4>No Drinks Found</h4>
                                <p>You haven't created any drinks yet.</p>
                                <a href="{{ route('admin.drinks.create') }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-plus-circle me-1"></i> Create Your First Drink
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- No Results Message -->
                <div id="noResults" class="d-none">
                    <div class="alert alert-info text-center py-4">
                        <i class="fas fa-search fa-2x mb-3"></i>
                        <h5>No matching drinks found</h5>
                        <p>Try different search criteria</p>
                    </div>
                </div>

                <!-- List View for Mobile -->
                <div class="d-md-none">
                    @if(count($drinks) > 0)
                        @foreach($drinks as $drink)
                            <div class="card mb-3 list-view-item drink-item-mobile" 
                                 data-name="{{ strtolower($drink->name) }}" 
                                 data-category="{{ strtolower($drink->category->name ?? '') }}"
                                 data-price="{{ $drink->price }}">
                                <div class="row g-0">
                                    <div class="col-4">
                                        <img src="{{ asset($drink->image_path) }}" 
                                             class="img-fluid rounded-start h-100" 
                                             alt="{{ $drink->name }}"
                                             style="object-fit: cover;">
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h5 class="card-title mb-1">{{ $drink->name }}</h5>
                                                <span class="badge bg-primary">{{ $drink->category->name ?? 'Uncategorized' }}</span>
                                            </div>
                                            <p class="card-text mb-1"><small class="text-muted">Rs.{{ number_format($drink->price, 2) }}</small></p>
                                            <div class="mt-2 d-flex gap-2">
                                                <a href="{{ route('admin.drinks.edit', $drink->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-danger mobile-delete-btn" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteModal{{ $drink->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info text-center py-5">
                            <i class="fas fa-info-circle fa-3x mb-3"></i>
                            <h4>No Drinks Found</h4>
                            <p>You haven't created any drinks yet.</p>
                            <a href="{{ route('admin.drinks.create') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-plus-circle me-1"></i> Create Your First Drink
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </main>

        <!-- JavaScript for search, filter, and sort functionality -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Elements
                const searchInput = document.getElementById('searchInput');
                const categoryFilter = document.getElementById('categoryFilter');
                const priceSort = document.getElementById('priceSort');
                const drinksContainer = document.getElementById('drinksContainer');
                const drinkItems = document.querySelectorAll('.drink-item');
                const drinkItemsMobile = document.querySelectorAll('.drink-item-mobile');
                const noResults = document.getElementById('noResults');
                
                // Function to filter and sort drinks
                function filterAndSortDrinks() {
                    const searchTerm = searchInput.value.toLowerCase();
                    const category = categoryFilter.value.toLowerCase();
                    const sortOrder = priceSort.value;
                    
                    // Filter desktop items
                    let visibleItems = 0;
                    
                    drinkItems.forEach(item => {
                        const name = item.dataset.name;
                        const itemCategory = item.dataset.category;
                        const matchesSearch = name.includes(searchTerm);
                        const matchesCategory = category === '' || itemCategory === category;
                        
                        if (matchesSearch && matchesCategory) {
                            item.style.display = 'block';
                            visibleItems++;
                        } else {
                            item.style.display = 'none';
                        }
                    });
                    
                    // Filter mobile items
                    drinkItemsMobile.forEach(item => {
                        const name = item.dataset.name;
                        const itemCategory = item.dataset.category;
                        const matchesSearch = name.includes(searchTerm);
                        const matchesCategory = category === '' || itemCategory === category;
                        
                        if (matchesSearch && matchesCategory) {
                            item.style.display = 'flex';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                    
                    // Sort items if needed
                    if (sortOrder !== '') {
                        const items = Array.from(drinkItems);
                        items.sort((a, b) => {
                            const priceA = parseFloat(a.dataset.price);
                            const priceB = parseFloat(b.dataset.price);
                            
                            if (sortOrder === 'low-high') {
                                return priceA - priceB;
                            } else {
                                return priceB - priceA;
                            }
                        });
                        
                        // Reorder in DOM
                        items.forEach(item => {
                            drinksContainer.appendChild(item);
                        });
                        
                        // Sort mobile items
                        const mobileItems = Array.from(drinkItemsMobile);
                        mobileItems.sort((a, b) => {
                            const priceA = parseFloat(a.dataset.price);
                            const priceB = parseFloat(b.dataset.price);
                            
                            if (sortOrder === 'low-high') {
                                return priceA - priceB;
                            } else {
                                return priceB - priceA;
                            }
                        });
                        
                        // Reorder mobile items
                        const mobileContainer = drinkItemsMobile[0].parentNode;
                        mobileItems.forEach(item => {
                            mobileContainer.appendChild(item);
                        });
                    }
                    
                    // Show/hide no results message
                    if (visibleItems === 0 && (searchTerm !== '' || category !== '')) {
                        noResults.classList.remove('d-none');
                    } else {
                        noResults.classList.add('d-none');
                    }
                }
                
                // Add event listeners
                searchInput.addEventListener('keyup', filterAndSortDrinks);
                categoryFilter.addEventListener('change', filterAndSortDrinks);
                priceSort.addEventListener('change', filterAndSortDrinks);
                
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
