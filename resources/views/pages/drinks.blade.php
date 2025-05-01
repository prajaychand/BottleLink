@extends('frontend.Master')

@section('content')

<div class="container py-5">


    <div class="row g-4">
        <!-- Sidebar with filters -->
        <div class="col-lg-3 col-md-4">
            <div class="sticky-top" style="top: 20px;">
                <h4 class="fw-bold mb-3 text-uppercase">Search & Filters</h4>
                <div class="card shadow-sm border-0 rounded-3 p-4">
                    <form method="GET" action="{{ route('search') }}" id="filterForm">

                        <!-- Search bar -->
                        <div class="mb-3">
                            <input type="text" name="query" class="form-control"
                                   value="{{ request('query') }}"
                                   placeholder="Search drinks..." onchange="this.form.submit();">
                        </div>

                        <!-- Price Range -->
                        <div class="mb-3">
                            <label for="min_price" class="form-label">Min Price</label>
                            <input type="number" name="min_price" id="min_price"
                                   value="{{ request('min_price') }}"
                                   class="form-control" onchange="this.form.submit();">
                        </div>

                        <div class="mb-3">
                            <label for="max_price" class="form-label">Max Price</label>
                            <input type="number" name="max_price" id="max_price"
                                   value="{{ request('max_price') }}"
                                   class="form-control" onchange="this.form.submit();">
                        </div>

                        <h5 class="filter-header mb-3 text-uppercase fs-6 fw-bold">Categories</h5>

                        <!-- Category checkboxes -->
                        @foreach($categories as $categoryItem)
                            <div class="form-check mb-2 d-flex align-items-center">
                                <input class="form-check-input me-2"
                                       type="checkbox"
                                       id="category-{{ $categoryItem->id }}"
                                       name="categories[]"
                                       value="{{ $categoryItem->id }}"
                                       {{ is_array(request('categories')) && in_array($categoryItem->id, request('categories')) ? 'checked' : '' }}
                                       onchange="document.getElementById('filterForm').submit();">
                                <label class="form-check-label w-100 cursor-pointer"
                                       for="category-{{ $categoryItem->id }}">{{ $categoryItem->name }}</label>
                            </div>
                        @endforeach

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
                                    <button class="btn btn-sm btn-light rounded-circle me-2 quick-view-btn" 
                                            title="Quick view" 
                                            data-id="{{ $drink->id }}"
                                            data-name="{{ $drink->name }}"
                                            data-description="{{ $drink->description }}"
                                            data-price="{{ $drink->price }}"
                                            data-image="{{ asset($drink->image_path) }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-light rounded-circle" title="Add to favorites">
                                        <i class="bi bi-heart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title fw-bold mb-2 product-name cursor-pointer"
                                    data-id="{{ $drink->id }}"
                                    data-name="{{ $drink->name }}"
                                    data-description="{{ $drink->description }}"
                                    data-price="{{ $drink->price }}"
                                    data-image="{{ asset($drink->image_path) }}">
                                    {{ $drink->name }}
                                </h5>
                                {{-- <p class="card-text mb-3">{{ $drink->description }}</p> --}}
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
                            <p class="text-muted">Try changing your search or filters</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Custom Product Modal (without Bootstrap modal component) -->
<div id="customProductModal" class="custom-modal">
    <div class="custom-modal-overlay"></div>
    <div class="custom-modal-container">
        <div class="custom-modal-content">
            <button type="button" class="custom-modal-close" id="closeCustomModal">
                <i class="fas fa-times"></i>
            </button>
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="product-modal-image-container">
                        <img id="modal-product-image" src="/placeholder.svg" class="w-100 h-100 object-fit-cover" alt="Product Image">
                    </div>
                </div>
                <div class="col-md-6 p-4 d-flex flex-column">
                    <div class="product-modal-content">
                        <h3 class="fw-bold mb-2 product-title" id="modal-product-name-inner">Product Name</h3>
                        <p class="text-primary fw-bold fs-4 mb-3 product-price" id="modal-product-price">Rs. 0.00</p>
                        <div class="product-divider"></div>
                        <p class="mb-4 product-description" id="modal-product-description">Product description goes here.</p>
                        
                        <div class="mt-auto">
                            <form id="modal-add-to-cart-form" action="" method="POST">
                                @csrf
                                <div class="d-flex align-items-center mb-4">
                                    <label for="quantity" class="me-3 fw-medium">Quantity:</label>
                                    <div class="quantity-control">
                                        <button type="button" class="quantity-btn" data-action="decrease">-</button>
                                        <input type="number" class="quantity-input" id="quantity" name="quantity" value="1" min="1">
                                        <button type="button" class="quantity-btn" data-action="increase">+</button>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 rounded-pill fw-medium py-2 add-to-cart-btn">
                                    <i class="bi bi-cart-plus me-2"></i>ADD TO CART
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
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
    
    /* Custom Modal Styles - No Bootstrap Modal */
    .custom-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1050;
    }
    
    .custom-modal.show {
        display: block;
    }
    
    .custom-modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }
    
    .custom-modal-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 90%;
        width: 800px;
        pointer-events: none;
    }
    
    .custom-modal-content {
        position: relative;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        pointer-events: auto;
        overflow: hidden;
    }
    
    .custom-modal-close {
        position: absolute;
        right: 15px;
        top: 15px;
        background-color: white;
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        z-index: 1060;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    
    .custom-modal-close:hover {
        transform: rotate(90deg);
        background-color: #f8f9fa;
    }
    
    .product-modal-image-container {
        height: 100%;
        min-height: 400px;
        overflow: hidden;
    }
    
    .product-modal-content {
        height: 100%;
        display: flex;
        flex-direction: column;
        padding: 10px;
    }
    
    .product-title {
        font-size: 1.75rem;
        color: #333;
    }
    
    .product-price {
        font-size: 1.5rem;
        color: #0d6efd;
    }
    
    .product-divider {
        width: 50px;
        height: 3px;
        background-color: #0d6efd;
        margin: 15px 0;
    }
    
    .product-description {
        color: #6c757d;
        line-height: 1.6;
        flex-grow: 1;
    }
    
    /* Enhanced Quantity input styling */
    .quantity-control {
        display: flex;
        align-items: center;
        border: 1px solid #dee2e6;
        border-radius: 30px;
        overflow: hidden;
    }
    
    .quantity-btn {
        width: 40px;
        height: 40px;
        background: none;
        border: none;
        font-size: 1.2rem;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    
    .quantity-btn:hover {
        background-color: #f8f9fa;
    }
    
    .quantity-input {
        width: 50px;
        height: 40px;
        border: none;
        text-align: center;
        font-weight: bold;
        -moz-appearance: textfield;
    }
    
    .quantity-input::-webkit-outer-spin-button,
    .quantity-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    .add-to-cart-btn {
        transition: all 0.3s ease;
        height: 48px;
        font-size: 1rem;
    }
    
    .add-to-cart-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }
    
    /* Animation for custom modal */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes slideIn {
        from { transform: translate(-50%, -60%); opacity: 0; }
        to { transform: translate(-50%, -50%); opacity: 1; }
    }
    
    .custom-modal.show .custom-modal-overlay {
        animation: fadeIn 0.3s ease forwards;
    }
    
    .custom-modal.show .custom-modal-container {
        animation: slideIn 0.3s ease forwards;
    }
    
    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .custom-modal-container {
            width: 95%;
        }
        
        .product-modal-image-container {
            min-height: 300px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const customModal = document.getElementById('customProductModal');
        const closeModalBtn = document.getElementById('closeCustomModal');
        const modalOverlay = document.querySelector('.custom-modal-overlay');
        
        // Function to open modal with product details
        function openProductModal(productData) {
            // Set product details in modal
            document.getElementById('modal-product-name-inner').textContent = productData.name;
            document.getElementById('modal-product-description').textContent = productData.description;
            document.getElementById('modal-product-price').textContent = 'Rs. ' + parseFloat(productData.price).toFixed(2);
            document.getElementById('modal-product-image').src = productData.image;
            document.getElementById('modal-product-image').alt = productData.name;
            
            // Set form action
            document.getElementById('modal-add-to-cart-form').action = '/cart/add/' + productData.id;
            
            // Reset quantity to 1
            document.getElementById('quantity').value = 1;
            
            // Show modal
            customModal.classList.add('show');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }
        
        // Function to close modal
        function closeProductModal() {
            customModal.classList.remove('show');
            document.body.style.overflow = ''; // Re-enable scrolling
        }
        
        // Close modal when clicking the close button
        closeModalBtn.addEventListener('click', closeProductModal);
        
        // Close modal when clicking outside the modal content
        modalOverlay.addEventListener('click', closeProductModal);
        
        // Prevent closing when clicking inside the modal content
        document.querySelector('.custom-modal-content').addEventListener('click', function(e) {
            e.stopPropagation();
        });
        
        // Close modal when pressing ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && customModal.classList.contains('show')) {
                closeProductModal();
            }
        });
        
        // Add click event to quick view buttons
        document.querySelectorAll('.quick-view-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const productData = {
                    id: this.getAttribute('data-id'),
                    name: this.getAttribute('data-name'),
                    description: this.getAttribute('data-description'),
                    price: this.getAttribute('data-price'),
                    image: this.getAttribute('data-image')
                };
                
                openProductModal(productData);
            });
        });
        
        // Add click event to product names
        document.querySelectorAll('.product-name').forEach(name => {
            name.addEventListener('click', function() {
                const productData = {
                    id: this.getAttribute('data-id'),
                    name: this.getAttribute('data-name'),
                    description: this.getAttribute('data-description'),
                    price: this.getAttribute('data-price'),
                    image: this.getAttribute('data-image')
                };
                
                openProductModal(productData);
            });
        });
        
        // Add click event to product images (the entire card)
        document.querySelectorAll('.product-image').forEach(image => {
            image.addEventListener('click', function() {
                const card = this.closest('.card');
                const nameElement = card.querySelector('.product-name');
                
                const productData = {
                    id: nameElement.getAttribute('data-id'),
                    name: nameElement.getAttribute('data-name'),
                    description: nameElement.getAttribute('data-description'),
                    price: nameElement.getAttribute('data-price'),
                    image: nameElement.getAttribute('data-image')
                };
                
                openProductModal(productData);
            });
        });
        
        // Quantity buttons functionality
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const input = document.getElementById('quantity');
                let value = parseInt(input.value);
                
                if (this.getAttribute('data-action') === 'increase') {
                    value++;
                } else {
                    value = Math.max(1, value - 1);
                }
                
                input.value = value;
            });
        });
        
        // Prevent form submission when pressing enter in quantity input
        document.getElementById('quantity').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                return false;
            }
        });
    });
</script>

@endsection