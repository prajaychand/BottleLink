@extends('frontend.Master')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h2 class="display-5 fw-bold mb-3">Photo Gallery</h2>
            <p class="text-muted lead">Explore our collection of stunning photography</p>
        </div>
    </div>
    
    <!-- Enhanced Image Grid with Animation -->
    <div class="row g-4" id="gallery-container">
        @foreach($galleries as $gallery)
        <div class="col-sm-6 col-md-4 col-lg-3 gallery-item-wrapper">
            <div class="card gallery-item shadow-sm h-100 overflow-hidden">
                <div class="image-container position-relative">
                    <img src="{{ asset($gallery->image) }}" class="card-img-top gallery-image" 
                         alt="{{ $gallery->title }}" data-index="{{ $loop->index }}"
                         data-username="{{ $gallery->user->name ?? 'Anonymous' }}"
                         loading="lazy">
                    <div class="image-overlay">
                        <span class="view-btn"><i class="bi bi-eye-fill me-2"></i>View</span>
                    </div>
                    @if($loop->first)
                    <div class="featured-badge">
                        <span class="badge bg-primary rounded-pill px-3 py-2">Featured</span>
                    </div>
                    @endif
                </div>
                <div class="card-body p-3">
                    <h6 class="card-title mb-1 text-truncate">{{ $gallery->title }}</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted small mb-0">
                            <i class="bi bi-person-circle me-1"></i>{{ $gallery->user->name ?? 'Anonymous' }}
                        </p>
                        <span class="like-btn" title="Like this photo">
                            <i class="bi bi-heart"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Optimized Gallery Modal with Better Dimensions -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered custom-modal-width">
            <div class="modal-content bg-dark">
                <!-- Top Navigation Bar with User Avatar -->
                <div class="modal-header border-0 bg-dark text-white py-3">
                    <div class="d-flex align-items-center">
                        <div class="user-initial-avatar me-2" id="modalUserAvatar">A</div>
                        <h5 class="modal-title fw-bold m-0" id="galleryModalLabel">BottleLink</h5>
                    </div>
                    
                    <!-- Custom close button with Font Awesome icon -->
                    <a href="javascript:void(0);" id="modalCloseBtn" class="modal-close-btn">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                
                <!-- Image Container with Zoom Functionality -->
                <div class="modal-body p-0 position-relative d-flex align-items-center justify-content-center">
                    <!-- Loading Spinner -->
                    <div class="position-absolute top-50 start-50 translate-middle" id="imageLoader">
                        <div class="spinner-grow text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    
                    <!-- Main Image with Zoom Container -->
                    <div class="image-wrapper position-relative">
                        <div class="zoom-container">
                            <img src="/placeholder.svg" id="modalImage" class="modal-img" alt="Gallery Image">
                        </div>
                    </div>
                </div>
                
                <!-- Image Info Footer -->
                <div class="modal-footer border-0 bg-dark text-white py-3 flex-column align-items-start">
                    <p id="modalTitle" class="mb-1 fw-bold fs-5"></p>
                    <p id="modalUsername" class="text-muted small mb-0">
                        <i class="bi bi-calendar me-1"></i>Uploaded by <span class="fw-medium"></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Custom CSS -->
<style>
    /* Gallery Grid Styles */
    .gallery-item-wrapper {
        transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .gallery-item-wrapper:hover {
        z-index: 1;
    }
    
    .gallery-item {
        transition: all 0.4s ease;
        cursor: pointer;
        border-radius: 12px;
        border: none;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    .gallery-item:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
    }
    
    .image-container {
        position: relative;
        overflow: hidden;
        background-color: #f8f9fa;
    }
    
    .gallery-image {
        height: 240px;
        object-fit: cover;
        transition: all 0.5s ease;
        width: 100%;
    }
    
    .gallery-item:hover .gallery-image {
        transform: scale(1.1);
    }
    
    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.3));
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.4s ease;
    }
    
    .view-btn {
        color: white;
        background: rgba(0,0,0,0.6);
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 500;
        transform: translateY(20px);
        transition: all 0.4s ease;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }
    
    .gallery-item:hover .image-overlay {
        opacity: 1;
    }
    
    .gallery-item:hover .view-btn {
        transform: translateY(0);
    }
    
    .view-btn:hover {
        background: rgba(0,0,0,0.8);
        transform: translateY(0) scale(1.05);
    }
    
    .featured-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 2;
    }
    
    .like-btn {
        cursor: pointer;
        transition: all 0.3s ease;
        color: #6c757d;
    }
    
    .like-btn:hover {
        color: #dc3545;
        transform: scale(1.2);
    }
    
    /* Enhanced Modal Styles with Better Dimensions */
    .custom-modal-width {
        max-width: 900px;
        width: 90%;
    }
    
    .modal-content {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }
    
    /* OPTIMIZED MODAL IMAGE STYLES */
    .modal-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
        margin: 0 auto;
        transition: all 0.4s ease;
        border-radius: 8px;
        opacity: 0;
        animation: fadeIn 0.4s ease forwards;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    
    .image-wrapper {
        width: 100%;
        height: 500px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        padding: 0;
        position: relative;
    }
    
    /* Zoom Container Styles */
    .zoom-container {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        cursor: zoom-in;
    }
    
    .zoom-container img {
        transition: transform 0.3s ease;
        max-width: 90%;
        max-height: 90%;
    }
    
    .zoom-container:hover img {
        transform: scale(1.5);
    }
    
    .zoom-instructions {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background-color: rgba(0, 0, 0, 0.6);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }
    
    .zoom-container:hover + .zoom-instructions {
        opacity: 0;
    }
    
    /* Responsive Image Sizing */
    @media (max-width: 1200px) {
        .image-wrapper {
            height: 450px;
        }
    }
    
    @media (max-width: 992px) {
        .image-wrapper {
            height: 400px;
        }
        
        .custom-modal-width {
            max-width: 800px;
        }
    }
    
    @media (max-width: 768px) {
        .image-wrapper {
            height: 350px;
        }
        
        .custom-modal-width {
            max-width: 95%;
        }
        
        .zoom-container:hover img {
            transform: scale(1.3); /* Less zoom on smaller screens */
        }
    }
    
    @media (max-width: 576px) {
        .image-wrapper {
            height: 300px;
        }
        
        .zoom-container img {
            max-width: 95%;
            max-height: 95%;
        }
    }
    
    /* User Avatar with Initial */
    .user-initial-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 18px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }
    
    /* Modal Animations */
    .modal.fade .modal-dialog {
        transform: scale(0.9);
        opacity: 0;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.4s ease;
    }
    
    .modal.show .modal-dialog {
        transform: scale(1);
        opacity: 1;
    }
    
    /* Loading Spinner */
    .spinner-grow {
        width: 3rem;
        height: 3rem;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .gallery-image {
            height: 200px;
        }
    }
    
    /* Animation for gallery items */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .gallery-item-wrapper {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
    }
    
    @media (prefers-reduced-motion: reduce) {
        .gallery-item-wrapper {
            animation: none;
            opacity: 1;
        }
    }

    /* Custom Font Awesome Close Button Styles */
    .modal-close-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: rgba(0, 0, 0, 0.5);
        border: none;
        color: white;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 1070; /* Increased z-index to be above modal-backdrop */
        transition: all 0.3s ease;
        padding: 0;
        text-decoration: none;
    }
    
    .modal-close-btn:hover {
        background-color: rgba(0, 0, 0, 0.8);
        transform: scale(1.1);
        color: #fff;
    }
    
    .modal-close-btn i {
        font-size: 18px;
    }
    
    /* Fix for modal header to ensure close button is visible */
    .modal-header {
        position: relative;
        z-index: 1050;
    }
    
    /* Hide the default Bootstrap close button */
    .btn-close-white {
        display: none;
    }
    
    /* Fix for modal-backdrop */
    .modal-backdrop {
        z-index: 1050 !important; /* Ensure it's below our close button */
    }
    
    /* Ensure the modal is above the backdrop */
    .modal {
        z-index: 1055 !important;
    }
    
    /* Enhanced footer styles */
    .modal-footer {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 1.5rem;
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all gallery images
        const galleryImages = document.querySelectorAll('.gallery-image');
        const modal = document.getElementById('galleryModal');
        const modalImage = document.getElementById('modalImage');
        const modalTitle = document.getElementById('modalTitle');
        const modalUsername = document.getElementById('modalUsername');
        const modalUserAvatar = document.getElementById('modalUserAvatar');
        const imageLoader = document.getElementById('imageLoader');
        const closeBtn = document.getElementById('modalCloseBtn');
        
        // Initialize Bootstrap modal with options
        const galleryModal = new bootstrap.Modal(modal, {
            backdrop: 'static', // Prevent closing when clicking outside
            keyboard: true // Allow ESC key to close
        });
        
        // Function to get initials from name
        function getInitials(name) {
            if (!name || name === 'Anonymous') return 'A';
            return name.split(' ')[0][0].toUpperCase();
        }
        
        // Add click event to all gallery items
        document.querySelectorAll('.gallery-item').forEach((item) => {
            item.addEventListener('click', function() {
                const image = this.querySelector('.gallery-image');
                const title = this.querySelector('.card-title').textContent;
                const username = image.getAttribute('data-username');
                
                // Show loader
                imageLoader.style.display = 'block';
                modalImage.style.opacity = '0';
                
                // Update modal content
                modalImage.src = image.src;
                modalImage.alt = image.alt;
                modalTitle.textContent = title;
                modalUsername.querySelector('span').textContent = username;
                
                // Set user initial in avatar
                modalUserAvatar.textContent = getInitials(username);
                                
                // Show modal
                galleryModal.show();
                
                // Hide loader when image is loaded
                modalImage.onload = function() {
                    imageLoader.style.display = 'none';
                    modalImage.style.opacity = '1';
                    
                    // Adjust image size based on orientation
                    adjustImageSize(this);
                };
            });
        });
        
        // Adjust image size based on its orientation
        function adjustImageSize(img) {
            // Reset any inline styles
            img.style.width = '';
            img.style.height = '';
            
            // Get natural dimensions
            const naturalWidth = img.naturalWidth;
            const naturalHeight = img.naturalHeight;
            
            // Check if image is portrait or landscape
            if (naturalHeight > naturalWidth) {
                // Portrait image
                img.classList.add('portrait');
                img.classList.remove('landscape');
                img.style.maxHeight = '90%';
                img.style.maxWidth = 'auto';
            } else {
                // Landscape or square image
                img.classList.add('landscape');
                img.classList.remove('portrait');
                img.style.maxWidth = '90%';
                img.style.maxHeight = 'auto';
            }
        }
        

        
        // Handle window resize to adjust image dimensions
        window.addEventListener('resize', function() {
            if (modal.classList.contains('show')) {
                adjustImageSize(modalImage);
            }
        });
        
        // Add like functionality
        document.querySelectorAll('.like-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                this.innerHTML = '<i class="bi bi-heart-fill text-danger"></i>';
                this.title = 'Liked';
            });
        });
        
        // Fix for modal-backdrop issue
        function removeBackdrop() {
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => {
                backdrop.remove();
            });
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        }
        
        // Ensure modal close button works properly
        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Hide the modal
                galleryModal.hide();
                
                // Remove backdrop after a short delay
                setTimeout(function() {
                    removeBackdrop();
                }, 300);
            });
        }
        
        // Handle modal hidden event to ensure backdrop is removed
        modal.addEventListener('hidden.bs.modal', function() {
            removeBackdrop();
        });
        
        // Add keyboard event to close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('show')) {
                galleryModal.hide();
                
                // Remove backdrop after a short delay
                setTimeout(function() {
                    removeBackdrop();
                }, 300);
            }
        });
        
        // Fix for any remaining backdrop issues
        setInterval(function() {
            if (!modal.classList.contains('show')) {
                removeBackdrop();
            }
        }, 1000);
    });
</script>
@endsection