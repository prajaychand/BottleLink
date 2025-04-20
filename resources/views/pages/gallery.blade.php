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

    <!-- Ultra Enhanced Gallery Modal -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-md-down modal-xl modal-dialog-centered">
            <div class="modal-content bg-dark">
                <!-- Top Navigation Bar -->
                <div class="modal-header border-0 bg-dark text-white py-3">
                    <div class="d-flex align-items-center">
                        <div class="modal-counter rounded-pill bg-black bg-opacity-50 px-3 py-1 me-3">
                            <span id="modalCounter" class="small">Image 1 of 10</span>
                        </div>
                        <h5 class="modal-title fw-bold m-0" id="galleryModalLabel">Gallery Image</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-light me-2 d-none d-md-block" id="fullscreenBtn">
                            <i class="bi bi-fullscreen"></i>
                        </button>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                
                <!-- Image Container -->
                <div class="modal-body p-0 position-relative d-flex align-items-center justify-content-center">
                    <!-- Loading Spinner -->
                    <div class="position-absolute top-50 start-50 translate-middle" id="imageLoader">
                        <div class="spinner-grow text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    
                    <!-- Main Image -->
                    <div class="image-wrapper position-relative w-100">
                        <img src="/placeholder.svg" id="modalImage" class="modal-img" alt="Gallery Image">
                    </div>
                    
                    <!-- Image Info Panel -->
                    <div class="image-info-panel">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h4 id="modalTitle" class="text-white mb-0"></h4>
                            <div class="d-flex">
                                <button class="btn btn-sm btn-outline-light me-2 action-btn" title="Download">
                                    <i class="bi bi-download"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-light action-btn" title="Like">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>
                        </div>
                        <div class="user-info d-flex align-items-center">
                            <div class="user-avatar me-2">
                                <i class="bi bi-person-circle fs-4"></i>
                            </div>
                            <div>
                                <p id="modalUsername" class="mb-0 fw-bold"></p>
                                <p class="text-muted small mb-0">Photographer</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation Controls -->
                    <button class="nav-btn prev-btn" id="prevBtn" title="Previous Image">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button class="nav-btn next-btn" id="nextBtn" title="Next Image">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
                
                <!-- Bottom Thumbnails -->
                <div class="modal-footer border-0 p-0 bg-black bg-opacity-75">
                    <div class="thumbnails-container d-flex overflow-auto py-2 px-3" id="thumbnailsContainer">
                        <!-- Thumbnails will be generated by JavaScript -->
                    </div>
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
    
    /* Enhanced Modal Styles */
    .modal-content {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }
    
    /* OPTIMIZED MODAL IMAGE STYLES */
    .modal-img {
        width: 75%;
        height: auto;
        max-width: 90%;
        max-height: 70vh;
        object-fit: contain;
        display: block;
        margin: 0 auto;
        transition: all 0.4s ease;
        box-shadow: 0 5px 25px rgba(0,0,0,0.4);
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
        height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        padding: 0;
        position: relative;
    }
    
    /* For landscape images */
    @media (orientation: landscape) {
        .modal-img {
            max-width: 85%;
            max-height: 75vh;
        }
        
        .image-wrapper {
            height: 75vh;
        }
    }
    
    /* For portrait images and mobile devices */
    @media (max-width: 768px) {
        .image-wrapper {
            height: 60vh;
        }
        
        .modal-img {
            max-width: 95%;
            max-height: 60vh;
        }
    }
    
    /* For very large screens */
    @media (min-width: 1600px) {
        .modal-img {
            max-height: 75vh;
            max-width: 80%;
        }
        
        .image-wrapper {
            height: 75vh;
        }
    }
    
    /* For extra small screens */
    @media (max-width: 576px) {
        .modal-img {
            max-width: 100%;
            max-height: 50vh;
        }
        
        .image-wrapper {
            height: 50vh;
        }
    }
    
    /* Navigation Buttons */
    .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.7);
        color: white;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
        opacity: 0.7;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }
    
    .nav-btn:hover {
        background: rgba(0, 0, 0, 0.9);
        opacity: 1;
        transform: translateY(-50%) scale(1.1);
    }
    
    .prev-btn {
        left: 20px;
    }
    
    .next-btn {
        right: 20px;
    }
    
    /* Image Info Panel */
    .image-info-panel {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.9), rgba(0,0,0,0.7) 60%, transparent);
        color: white;
        padding: 20px;
        z-index: 5;
        transform: translateY(0);
        transition: transform 0.3s ease;
    }
    
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .action-btn {
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .action-btn:hover {
        transform: scale(1.1);
    }
    
    /* Thumbnails */
    .thumbnails-container {
        scrollbar-width: thin;
        scrollbar-color: rgba(255,255,255,0.3) transparent;
    }
    
    .thumbnails-container::-webkit-scrollbar {
        height: 6px;
    }
    
    .thumbnails-container::-webkit-scrollbar-track {
        background: transparent;
    }
    
    .thumbnails-container::-webkit-scrollbar-thumb {
        background-color: rgba(255,255,255,0.3);
        border-radius: 6px;
    }
    
    .thumbnail {
        width: 70px;
        height: 70px;
        border-radius: 8px;
        object-fit: cover;
        margin: 0 5px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        opacity: 0.7;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    
    .thumbnail.active {
        border-color: #0d6efd;
        opacity: 1;
        transform: scale(1.05);
    }
    
    .thumbnail:hover {
        opacity: 1;
        transform: translateY(-3px);
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
        .nav-btn {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }
        
        .prev-btn {
            left: 10px;
        }
        
        .next-btn {
            right: 10px;
        }
        
        .gallery-image {
            height: 200px;
        }
        
        .image-info-panel {
            padding: 15px;
        }
        
        .thumbnail {
            width: 60px;
            height: 60px;
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

</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all gallery images
        const galleryImages = document.querySelectorAll('.gallery-image');
        const modal = document.getElementById('galleryModal');
        const modalImage = document.getElementById('modalImage');
        const modalTitle = document.getElementById('modalTitle');
        const modalUsername = document.getElementById('modalUsername');
        const modalCounter = document.getElementById('modalCounter');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const imageLoader = document.getElementById('imageLoader');
        const thumbnailsContainer = document.getElementById('thumbnailsContainer');
        const fullscreenBtn = document.getElementById('fullscreenBtn');
        
        let currentIndex = 0;
        const totalImages = galleryImages.length;
        
        // Initialize Bootstrap modal
        const galleryModal = new bootstrap.Modal(modal);
        
        // Generate thumbnails
        function generateThumbnails() {
            thumbnailsContainer.innerHTML = '';
            galleryImages.forEach((img, index) => {
                const thumbnail = document.createElement('img');
                thumbnail.src = img.src;
                thumbnail.alt = 'Thumbnail';
                thumbnail.className = 'thumbnail';
                thumbnail.dataset.index = index;
                
                thumbnail.addEventListener('click', function() {
                    currentIndex = parseInt(this.dataset.index);
                    updateModal(currentIndex);
                });
                
                thumbnailsContainer.appendChild(thumbnail);
            });
        }
        
        // Add click event to all gallery items
        document.querySelectorAll('.gallery-item').forEach((item, index) => {
            item.addEventListener('click', function() {
                const image = this.querySelector('.gallery-image');
                currentIndex = parseInt(image.getAttribute('data-index'));
                
                // Generate thumbnails when modal opens
                generateThumbnails();
                
                // Show modal and update content
                galleryModal.show();
                updateModal(currentIndex);
            });
        });
        
        // Previous button click
        prevBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            navigateImage('prev');
        });
        
        // Next button click
        nextBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            navigateImage('next');
        });
        
        // Fullscreen button click
        if (fullscreenBtn) {
            fullscreenBtn.addEventListener('click', function() {
                toggleFullscreen();
            });
        }
        
        // Toggle fullscreen
        function toggleFullscreen() {
            if (!document.fullscreenElement) {
                modal.requestFullscreen().catch(err => {
                    console.log(`Error attempting to enable fullscreen: ${err.message}`);
                });
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }
        
        // Navigate to previous or next image with animation
        function navigateImage(direction) {
            // Show loader
            imageLoader.style.display = 'block';
            modalImage.style.opacity = '0';
            
            // Change index
            if (direction === 'prev') {
                currentIndex = (currentIndex - 1 + totalImages) % totalImages;
            } else {
                currentIndex = (currentIndex + 1) % totalImages;
            }
            
            // Update modal after a short delay for animation
            setTimeout(() => {
                updateModal(currentIndex);
            }, 300);
        }
        
        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (!modal.classList.contains('show')) return;
            
            if (e.key === 'ArrowLeft') {
                navigateImage('prev');
            } else if (e.key === 'ArrowRight') {
                navigateImage('next');
            } else if (e.key === 'Escape') {
                galleryModal.hide();
            } else if (e.key === 'f') {
                toggleFullscreen();
            }
        });
        
        // Update modal content
        function updateModal(index) {
            const image = galleryImages[index];
            const title = image.closest('.gallery-item').querySelector('.card-title').textContent;
            const username = image.getAttribute('data-username');
            
            // Show loader while image loads
            imageLoader.style.display = 'block';
            modalImage.style.opacity = '0';
            
            // Update image source
            modalImage.src = image.src;
            modalImage.alt = image.alt;
            
            // Update text content
            modalTitle.textContent = title;
            modalUsername.textContent = username;
            modalCounter.textContent = `Image ${index + 1} of ${totalImages}`;
            
            // Update active thumbnail
            document.querySelectorAll('.thumbnail').forEach((thumb, i) => {
                if (i === index) {
                    thumb.classList.add('active');
                    thumb.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                } else {
                    thumb.classList.remove('active');
                }
            });
            
            // Hide loader when image is loaded
            modalImage.onload = function() {
                imageLoader.style.display = 'none';
                modalImage.style.opacity = '1';
                
                // Adjust image size based on orientation
                adjustImageSize(this);
            };
        }
        
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
            } else {
                // Landscape or square image
                img.classList.add('landscape');
                img.classList.remove('portrait');
            }
        }
        
        // Swipe support for touch devices
        let touchStartX = 0;
        let touchEndX = 0;
        
        modal.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, false);
        
        modal.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, false);
        
        function handleSwipe() {
            const swipeThreshold = 50;
            if (touchEndX < touchStartX - swipeThreshold) {
                // Swipe left - next image
                navigateImage('next');
            } else if (touchEndX > touchStartX + swipeThreshold) {
                // Swipe right - previous image
                navigateImage('prev');
            }
        }
        
        // Preload images for smoother navigation
        function preloadImages() {
            galleryImages.forEach(img => {
                const preloadLink = document.createElement('link');
                preloadLink.href = img.src;
                preloadLink.rel = 'preload';
                preloadLink.as = 'image';
                document.head.appendChild(preloadLink);
            });
        }
        
        // Call preload function
        preloadImages();
        
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
    });
</script>
@endsection