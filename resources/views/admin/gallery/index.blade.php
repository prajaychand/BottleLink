@extends('admin.layout')

@section('content')
<style>
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

    .search-container {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    @media (max-width: 767.98px) {
        .card-img-top {
            height: 150px;
        }
    }
</style>

<x-app-layout>
    <main id="main" class="main">
        <div class="container py-5">
            <!-- Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h1 class="fw-bold text-primary mb-0">Galleries Menu</h1>
                            <p class="text-muted">Manage your uploaded galleries</p>
                        </div>
                        {{-- <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle me-2"></i> Add Gallery
                        </a> --}}
                    </div>
                </div>
            </div>

            <!-- Search -->
            <div class="search-container mb-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" id="searchInput" placeholder="Search by title...">
                    </div>
                </div>
            </div>

            <!-- Grid View -->
            <div class="row d-none d-md-flex" id="drinksContainer">
                @if(count($galleries) > 0)
                    @foreach($galleries as $gallery)
                        <div class="col-md-6 col-lg-4 mb-4 drink-item" data-title="{{ strtolower($gallery->title) }}">
                            <div class="card h-100 border-0 shadow-sm hover-shadow">
                                <div class="position-relative">
                                    <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}" class="card-img-top">
                                </div>
                                <div class="card-body p-3">
                                    <h6 class="card-title mb-1 text-truncate">{{ $gallery->title }}</h6>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted small mb-0">
                                            <i class="bi bi-person-circle me-1"></i>{{ $gallery->user->name ?? 'Anonymous' }}
                                        </p>
                                        {{-- <span class="like-btn" title="Like this photo">
                                            <i class="bi bi-heart"></i>
                                        </span> --}}
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-0">
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-outline-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $gallery->id }}">
                                            <i class="fas fa-trash me-1"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $gallery->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $gallery->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $gallery->id }}">Confirm Delete</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete <strong>{{ $gallery->title }}</strong>?</p>
                                        <p class="text-danger"><i class="fas fa-exclamation-triangle me-1"></i> This action cannot be undone.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete Gallery</button>
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
                            <h4>No Galleries Found</h4>
                            <p>You haven't created any galleries yet.</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- No Results -->
            <div id="noResults" class="d-none">
                <div class="alert alert-info text-center py-4">
                    <i class="fas fa-search fa-2x mb-3"></i>
                    <h5>No matching galleries found</h5>
                    <p>Try a different search</p>
                </div>
            </div>
            {{-- {{dd($galleries)}} --}}
            <!-- Mobile View -->
            <div class="d-md-none">
                @if(count($galleries) > 0)
                    @foreach($galleries as $gallery)
                   
                        <div class="card mb-3 drink-item-mobile" data-title="{{ strtolower($gallery->title) }}">
                            <div class="row g-0">
                                <div class="col-4">
                                    <img src="{{ asset($gallery->image) }}" class="img-fluid rounded-start h-100" alt="{{ $gallery->title }}" style="object-fit: cover;">
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h5 class="card-title mb-1">{{ $gallery->title }}</h5>
                                        </div>
                                        <div class="mt-2 d-flex gap-2">
                                            <button type="button" class="btn btn-sm btn-outline-danger mobile-delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $gallery->id }}">
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
                        <h4>No Galleries Found</h4>
                        <p>You haven't created any galleries yet.</p>
                        <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-plus-circle me-1"></i> Create Your First Gallery
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const drinkItems = document.querySelectorAll('.drink-item');
            const drinkItemsMobile = document.querySelectorAll('.drink-item-mobile');
            const noResults = document.getElementById('noResults');

            function filterGalleries() {
                const searchTerm = searchInput.value.toLowerCase();
                let visibleCount = 0;

                drinkItems.forEach(item => {
                    const title = item.dataset.title;
                    if (title.includes(searchTerm)) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                drinkItemsMobile.forEach(item => {
                    const title = item.dataset.title;
                    if (title.includes(searchTerm)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });

                noResults.classList.toggle('d-none', visibleCount > 0 || searchTerm === '');
            }

            searchInput.addEventListener('keyup', filterGalleries);

            // Bootstrap delete modal
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
