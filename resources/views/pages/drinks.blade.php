@extends('frontend.Master')

@section('content')
    <div class="container py-5">
        <div class="row g-4">
            <!-- Sidebar with filters -->
            <div class="col-lg-3 col-md-4">
                <div class="sticky-top" style="top: 20px;">
                    <h4 class="fw-bold mb-3 text-uppercase">Filters</h4>
                    <div class="card shadow-sm border-0 rounded-3 p-4">
                        <form method="GET" action="{{ route('drinks', ['id' => $category->id]) }}" id="filterForm">

                            <h5 class="filter-header mb-3 text-uppercase fs-6 fw-bold">Drinks Categories</h5>

                            <!-- All category checkbox -->
                            <div class="form-check mb-2 d-flex align-items-center">
                                <input class="form-check-input me-2" type="checkbox" id="all" 
                                       name="categories[]" value="all" 
                                       {{ in_array('all', request()->input('categories', [])) ? 'checked' : '' }} 
                                       onchange="document.getElementById('filterForm').submit();">
                                <label class="form-check-label w-100 cursor-pointer" for="all">All</label>
                            </div>

                            <!-- Category checkboxes -->
                            @foreach($categories as $categoryItem)
                                <div class="form-check mb-2 d-flex align-items-center">
                                    <input class="form-check-input me-2" type="checkbox" 
                                           id="category-{{$categoryItem->id}}" 
                                           name="categories[]" 
                                           value="{{ $categoryItem->id }}" 
                                           {{ in_array($categoryItem->id, request()->input('categories', [])) ? 'checked' : '' }} 
                                           onchange="document.getElementById('filterForm').submit();">
                                    <label class="form-check-label w-100 cursor-pointer" for="category-{{$categoryItem->id}}">{{$categoryItem->name}}</label>
                                </div>
                            @endforeach

                            <hr class="my-2 text-muted">

                        </form>
                    </div>
                </div>
            </div>

            <!-- Main content area -->
            <div class="col-lg-9 col-md-8">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-4">
                    @forelse($drinks as $drink)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden transition-all hover-scale">
                                <div class="product-image position-relative overflow-hidden" style="height: 200px;">
                                    <img src="{{ asset($drink->image_path) }}" 
                                         class="card-img-top h-100 w-100 object-fit-cover transition-all" 
                                         alt="{{ $drink->name }}">
                                    <div class="product-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-25 opacity-0 transition-all">
                                        <button class="btn btn-sm btn-light rounded-circle me-2" title="Quick view">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-light rounded-circle" title="Add to favorites">
                                            <i class="bi bi-heart"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column p-4">
                                    <h5 class="card-title fw-bold mb-2">{{ $drink->name }}</h5>
                                    <p class="card-text mb-3">{{ $drink->description }}</p> <!-- Added description -->
                                    <p class="card-text fw-bold text-primary mb-3">Rs. {{ number_format($drink->price, 2) }}</p>

                                    <form action="{{ route('cart.add', ['id' => $drink->id]) }}" method="POST" class="mt-auto">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100 rounded-pill fw-medium add-to-cart">
                                            <i class="bi bi-cart-plus me-2"></i>ADD TO CART
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 py-5 text-center">
                            <div class="py-5">
                                <i class="bi bi-emoji-frown display-1 text-muted"></i>
                                <h4 class="mt-3">No Drinks Found</h4>
                                <p class="text-muted">Try adjusting your filters or browse other categories</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <style>
        .cursor-pointer {
            cursor: pointer;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .hover-scale:hover {
            transform: translateY(-5px);
        }

        .hover-scale:hover .product-overlay {
            opacity: 1;
        }

        .hover-scale:hover img {
            transform: scale(1.05);
        }

        .object-fit-cover {
            object-fit: cover;
        }
    </style>
@endsection
