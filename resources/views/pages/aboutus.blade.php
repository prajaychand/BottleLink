@extends('frontend.Master')

@section('content')
<div class="about-page py-5">
    <div class="container">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <div class="position-relative mb-4">
                <div class="d-inline-block position-relative">
                    <h1 class="display-4 fw-bold text-dark">About BottleLink</h1>
                    <div class="position-absolute" style="height: 8px; width: 60%; background-color: #FFD700; bottom: -5px; left: 20%; border-radius: 4px;"></div>
                </div>
            </div>
            <p class="lead text-light mx-auto" style="max-width: 700px; font-size: 1.2rem; opacity: 0.8;">
                Your trusted partner in premium alcohol delivery.
            </p>
        </div>

        <!-- Main Content -->
        <div class="card border-0 shadow-lg mb-5" style="border-radius: 15px; overflow: hidden; background-color: #1E1E1E; border: 1px solid #333;">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="card-body p-5">
                        <div class="mb-4 position-relative">
                            <div style="width: 50px; height: 5px; background-color: #FFD700; margin-bottom: 15px; border-radius: 3px;"></div>
                            <h2 class="fw-bold mb-3" style="color: #FFD700;">Who We Are</h2>
                            <p class="text-light" style="font-size: 1.05rem; line-height: 1.7; opacity: 0.9;">
                                BootleLink is a fast-growing online alcohol delivery platform dedicated to bringing your favorite drinks directly to your doorstep. From local favorites to top international brands, we make it easy for you to discover and enjoy premium liquors without leaving your home.
                            </p>
                        </div>

                        <div class="mt-5 position-relative">
                            <div style="width: 50px; height: 5px; background-color: #FFD700; margin-bottom: 15px; border-radius: 3px;"></div>
                            <h2 class="fw-bold mb-3" style="color: #FFD700;">Why Choose Us?</h2>
                            <ul class="list-unstyled" style="font-size: 1.05rem; line-height: 1.7;">
                                <li class="mb-3 d-flex align-items-center">
                                    <span class="d-inline-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; background-color: #FFD700; color: #000; border-radius: 50%; font-weight: bold;">✓</span>
                                    <span class="text-light" style="opacity: 0.9;">Fast & Reliable Delivery</span>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <span class="d-inline-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; background-color: #FFD700; color: #000; border-radius: 50%; font-weight: bold;">✓</span>
                                    <span class="text-light" style="opacity: 0.9;">Wide Selection of Beverages</span>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <span class="d-inline-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; background-color: #FFD700; color: #000; border-radius: 50%; font-weight: bold;">✓</span>
                                    <span class="text-light" style="opacity: 0.9;">Verified & Licensed Sellers</span>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <span class="d-inline-flex align-items-center justify-content-center me-3" style="width: 30px; height: 30px; background-color: #FFD700; color: #000; border-radius: 50%; font-weight: bold;">✓</span>
                                    <span class="text-light" style="opacity: 0.9;">Secure & Easy Payment Options</span>
                                </li>
                            </ul>

                            <p class="mt-4 text-light" style="font-size: 1.05rem; line-height: 1.7; opacity: 0.9;">
                                Whether you're planning a celebration or just want to relax after a long day, BootleLink is here to serve you with quality, convenience, and care.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card h-100 border-0 text-center p-4" style="background-color: #1E1E1E; border-radius: 15px; border-bottom: 5px solid #FFD700;">
                    <div class="card-body">
                        <div class="d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; background-color: rgba(255, 215, 0, 0.1); border-radius: 50%;">
                            <i class="fas fa-truck" style="font-size: 30px; color: #FFD700;"></i>
                        </div>
                        <h3 class="text-white mb-2 counter" data-target="950">0</h3>
                        <p class="text-light" style="opacity: 0.7;">Deliveries Completed</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 text-center p-4" style="background-color: #1E1E1E; border-radius: 15px; border-bottom: 5px solid #FFD700;">
                    <div class="card-body">
                        <div class="d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; background-color: rgba(255, 215, 0, 0.1); border-radius: 50%;">
                            <i class="fas fa-wine-bottle" style="font-size: 30px; color: #FFD700;"></i>
                        </div>
                        <h3 class="text-white mb-2 counter" data-target="500">0</h3>
                        <p class="text-light" style="opacity: 0.7;">Premium Brands</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 text-center p-4" style="background-color: #1E1E1E; border-radius: 15px; border-bottom: 5px solid #FFD700;">
                    <div class="card-body">
                        <div class="d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; background-color: rgba(255, 215, 0, 0.1); border-radius: 50%;">
                            <i class="fas fa-users" style="font-size: 30px; color: #FFD700;"></i>
                        </div>
                        <h3 class="text-white mb-2 counter" data-target="1000">0</h3>
                        <p class="text-light" style="opacity: 0.7;">Happy Customers</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .about-page {
        color: #fff;
    }
    @media (min-width: 768px) {
        .about-page .col-md-6:first-child img {
            height: 100%;
            object-fit: cover;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const counters = document.querySelectorAll('.counter');
        const speed = 100; // smaller = faster

        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;

                // calculate increment
                const increment = target / speed;

                // if count is less than target, add increment
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 20); // smooth animation
                } else {
                    counter.innerText = target; // ensure exact target
                }
            };

            updateCount();
        });
    });
</script>

@endsection