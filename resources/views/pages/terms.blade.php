@extends('frontend.Master')

@section('content')
<div class="terms-page py-5">
    <div class="container">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <div class="position-relative mb-4">
                <div class="d-inline-block position-relative">
                    <h1 class="display-4 fw-bold text-dark">Terms and Conditions</h1>
                    <div class="position-absolute" style="height: 8px; width: 60%; background-color: #FFD700; bottom: -5px; left: 20%; border-radius: 4px;"></div>
                </div>
            </div>
            <p class="lead text-light mx-auto" style="max-width: 700px; font-size: 1.2rem; opacity: 0.8;">
                Please read these terms carefully before using our services at BootleLink.
            </p>
        </div>
        
        <!-- Main Content -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Table of Contents Card -->
                <div class="card mb-4 border-0 shadow-lg" style="border-radius: 15px; overflow: hidden; background-color: #1E1E1E; border: 1px solid #333;">
                    <div class="card-header p-4" style="background-color: #FFD700;">
                        <h4 class="mb-0 fw-bold text-dark"><i class="fas fa-list-ul me-2"></i> Quick Navigation</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><a href="#section1" class="text-decoration-none d-flex align-items-center text-white">
                                        <span class="badge rounded-pill me-2" style="background-color: #FFD700; color: #000;">1</span> Legal Drinking Age
                                    </a></li>
                                    <li class="mb-2"><a href="#section2" class="text-decoration-none d-flex align-items-center text-white">
                                        <span class="badge rounded-pill me-2" style="background-color: #FFD700; color: #000;">2</span> Orders and Delivery
                                    </a></li>
                                    <li class="mb-2"><a href="#section3" class="text-decoration-none d-flex align-items-center text-white">
                                        <span class="badge rounded-pill me-2" style="background-color: #FFD700; color: #000;">3</span> Payment
                                    </a></li>
                                    <li class="mb-2"><a href="#section4" class="text-decoration-none d-flex align-items-center text-white">
                                        <span class="badge rounded-pill me-2" style="background-color: #FFD700; color: #000;">4</span> Returns and Refunds
                                    </a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><a href="#section5" class="text-decoration-none d-flex align-items-center text-white">
                                        <span class="badge rounded-pill me-2" style="background-color: #FFD700; color: #000;">5</span> User Responsibilities
                                    </a></li>
                                    <li class="mb-2"><a href="#section6" class="text-decoration-none d-flex align-items-center text-white">
                                        <span class="badge rounded-pill me-2" style="background-color: #FFD700; color: #000;">6</span> Privacy
                                    </a></li>
                                    <li class="mb-2"><a href="#section7" class="text-decoration-none d-flex align-items-center text-white">
                                        <span class="badge rounded-pill me-2" style="background-color: #FFD700; color: #000;">7</span> Changes to Terms
                                    </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Terms Content Card -->
                <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden; background-color: #1E1E1E; border: 1px solid #333;">
                    <div class="card-body p-0">
                        <!-- Section 1 -->
                        <div id="section1" class="p-5 position-relative" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                            <div class="position-absolute" style="width: 5px; height: 70%; background-color: #FFD700; left: 0; top: 15%; border-radius: 0 4px 4px 0;"></div>
                            <h3 class="fw-bold mb-4" style="color: #FFD700;">1. Legal Drinking Age</h3>
                            <p class="text-light mb-0" style="font-size: 1.05rem; line-height: 1.7; opacity: 0.9;">
                                By using BootleLink, you confirm that you are of legal drinking age in your region. We strictly do not sell alcohol to individuals under the legal age limit.
                            </p>
                        </div>
                        
                        <!-- Section 2 -->
                        <div id="section2" class="p-5 position-relative" style="border-bottom: 1px solid rgba(255,255,255,0.1); background-color: #252525;">
                            <div class="position-absolute" style="width: 5px; height: 70%; background-color: #FFD700; left: 0; top: 15%; border-radius: 0 4px 4px 0;"></div>
                            <h3 class="fw-bold mb-4" style="color: #FFD700;">2. Orders and Delivery</h3>
                            <p class="text-light mb-0" style="font-size: 1.05rem; line-height: 1.7; opacity: 0.9;">
                                All orders are subject to availability. Delivery timelines may vary depending on location, product availability, and order volume. Valid identification may be required upon delivery.
                            </p>
                        </div>
                        
                        <!-- Section 3 -->
                        <div id="section3" class="p-5 position-relative" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                            <div class="position-absolute" style="width: 5px; height: 70%; background-color: #FFD700; left: 0; top: 15%; border-radius: 0 4px 4px 0;"></div>
                            <h3 class="fw-bold mb-4" style="color: #FFD700;">3. Payment</h3>
                            <p class="text-light mb-0" style="font-size: 1.05rem; line-height: 1.7; opacity: 0.9;">
                                We accept multiple payment options. All payments must be completed before dispatch. BootleLink is not responsible for third-party payment gateway issues.
                            </p>
                        </div>
                        
                        <!-- Section 4 -->
                        <div id="section4" class="p-5 position-relative" style="border-bottom: 1px solid rgba(255,255,255,0.1); background-color: #252525;">
                            <div class="position-absolute" style="width: 5px; height: 70%; background-color: #FFD700; left: 0; top: 15%; border-radius: 0 4px 4px 0;"></div>
                            <h3 class="fw-bold mb-4" style="color: #FFD700;">4. Returns and Refunds</h3>
                            <p class="text-light mb-0" style="font-size: 1.05rem; line-height: 1.7; opacity: 0.9;">
                                Alcohol products are non-returnable unless they are damaged or incorrect upon delivery. Please contact our support team within 24 hours of delivery for any issues.
                            </p>
                        </div>
                        
                        <!-- Section 5 -->
                        <div id="section5" class="p-5 position-relative" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                            <div class="position-absolute" style="width: 5px; height: 70%; background-color: #FFD700; left: 0; top: 15%; border-radius: 0 4px 4px 0;"></div>
                            <h3 class="fw-bold mb-4" style="color: #FFD700;">5. User Responsibilities</h3>
                            <p class="text-light mb-0" style="font-size: 1.05rem; line-height: 1.7; opacity: 0.9;">
                                Users agree not to misuse the platform, create fraudulent accounts, or use the service for unlawful purposes. Any such activity will lead to account termination and possible legal action.
                            </p>
                        </div>
                        
                        <!-- Section 6 -->
                        <div id="section6" class="p-5 position-relative" style="border-bottom: 1px solid rgba(255,255,255,0.1); background-color: #252525;">
                            <div class="position-absolute" style="width: 5px; height: 70%; background-color: #FFD700; left: 0; top: 15%; border-radius: 0 4px 4px 0;"></div>
                            <h3 class="fw-bold mb-4" style="color: #FFD700;">6. Privacy</h3>
                            <p class="text-light mb-0" style="font-size: 1.05rem; line-height: 1.7; opacity: 0.9;">
                                We value your privacy. Please refer to our Privacy Policy to understand how your data is handled and protected.
                            </p>
                        </div>
                        
                        <!-- Section 7 -->
                        <div id="section7" class="p-5 position-relative">
                            <div class="position-absolute" style="width: 5px; height: 70%; background-color: #FFD700; left: 0; top: 15%; border-radius: 0 4px 4px 0;"></div>
                            <h3 class="fw-bold mb-4" style="color: #FFD700;">7. Changes to Terms</h3>
                            <p class="text-light mb-0" style="font-size: 1.05rem; line-height: 1.7; opacity: 0.9;">
                                BootleLink reserves the right to update these terms at any time. Continued use of the site after changes indicates acceptance of the new terms.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Footer -->
                    <div class="card-footer p-4 text-center" style="background-color: #252525; border-top: 1px solid rgba(255,255,255,0.1);">
                        <p class="text-light mb-3">Last updated: May 1, 2025</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('home') }}" class="btn px-4 py-2 rounded-pill shadow-sm" style="background-color: #FFD700; color: #000; font-weight: 600;">
                                <i class="fas fa-home me-2"></i> Back to Home
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .terms-page a:hover {
        color: #FFD700 !important;
    }
    .badge {
        transition: all 0.3s;
    }
    .terms-page a:hover .badge {
        transform: scale(1.1);
    }
</style>
@endsection