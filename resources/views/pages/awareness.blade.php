@extends('frontend.Master')

@section('content')
<div class="terms-page py-5">
    <div class="container">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <div class="position-relative mb-4">
                <div class="d-inline-block position-relative">
                    <h1 class="display-4 fw-bold text-dark">Campaign for Responsible Drinking</h1>
                    <div class="position-absolute" style="height: 8px; width: 60%; background-color: #FFD700; bottom: -5px; left: 20%; border-radius: 4px;"></div>
                </div>
            </div>
            <p class="lead text-light mx-auto" style="max-width: 700px; font-size: 1.2rem; opacity: 0.8;">
                Join BootleLink’s mission to raise awareness about the effects of alcohol and promote a safer, healthier drinking culture.
            </p>
        </div>

        <!-- Main Content -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Table of Contents Card -->
                <div class="card mb-4 border-0 shadow-lg" style="border-radius: 15px; overflow: hidden; background-color: #1E1E1E; border: 1px solid #333;">
                    <div class="card-header p-4" style="background-color: #FFD700;">
                        <h4 class="mb-0 fw-bold text-dark"><i class="fas fa-bullhorn me-2"></i> Awareness Topics</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><a href="#section1" class="text-decoration-none d-flex align-items-center text-white">
                                        <span class="badge rounded-pill me-2" style="background-color: #FFD700; color: #000;">1</span> Understanding Responsible Drinking
                                    </a></li>
                                    <li class="mb-2"><a href="#section2" class="text-decoration-none d-flex align-items-center text-white">
                                        <span class="badge rounded-pill me-2" style="background-color: #FFD700; color: #000;">2</span> Effects of Excessive Consumption
                                    </a></li>
                                    <li class="mb-2"><a href="#section3" class="text-decoration-none d-flex align-items-center text-white">
                                        <span class="badge rounded-pill me-2" style="background-color: #FFD700; color: #000;">3</span> Safe Social Practices
                                    </a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                 
                                    <li class="mb-2"><a href="#section6" class="text-decoration-none d-flex align-items-center text-white">
                                        <span class="badge rounded-pill me-2" style="background-color: #FFD700; color: #000;">4</span> Community Initiatives
                                    </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Campaign Sections -->
                <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden; background-color: #1E1E1E; border: 1px solid #333;">
                    <div class="card-body p-0">
                        <!-- Section 1 -->
                        <div id="section1" class="p-5 position-relative" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                            <div class="position-absolute" style="width: 5px; height: 70%; background-color: #FFD700; left: 0; top: 15%; border-radius: 0 4px 4px 0;"></div>
                            <h3 class="fw-bold mb-4" style="color: #FFD700;">1. Understanding Responsible Drinking</h3>
                            <p class="text-light mb-0" style="font-size: 1.05rem; line-height: 1.7; opacity: 0.9;">
                                Responsible drinking means being aware of the impact of alcohol on your health and behavior, and making choices that avoid harm. It involves understanding limits, respecting social settings, and knowing when to say no.
                            </p>
                        </div>

                        <!-- Section 2 -->
                        <div id="section2" class="p-5 position-relative" style="border-bottom: 1px solid rgba(255,255,255,0.1); background-color: #252525;">
                            <div class="position-absolute" style="width: 5px; height: 70%; background-color: #FFD700; left: 0; top: 15%; border-radius: 0 4px 4px 0;"></div>
                            <h3 class="fw-bold mb-4" style="color: #FFD700;">2. Effects of Excessive Consumption</h3>
                            <p class="text-light mb-0" style="font-size: 1.05rem; line-height: 1.7; opacity: 0.9;">
                                Drinking in excess can lead to long-term health issues including liver damage, heart problems, and mental health concerns. It also increases the risk of accidents and poor decision-making. Awareness of these risks helps reduce harm.
                            </p>
                        </div>

                        <!-- Section 3 -->
                        <div id="section3" class="p-5 position-relative" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                            <div class="position-absolute" style="width: 5px; height: 70%; background-color: #FFD700; left: 0; top: 15%; border-radius: 0 4px 4px 0;"></div>
                            <h3 class="fw-bold mb-4" style="color: #FFD700;">3. Safe Social Practices</h3>
                            <p class="text-light mb-0" style="font-size: 1.05rem; line-height: 1.7; opacity: 0.9;">
                                If you choose to drink, always do so in a safe environment. Never drink and drive, monitor your intake, and stay with trusted friends. Plan ahead and be mindful of your surroundings.
                            </p>
                        </div>

                       

                        <!-- Section 6 -->
                        <div id="section6" class="p-5 position-relative">
                            <div class="position-absolute" style="width: 5px; height: 70%; background-color: #FFD700; left: 0; top: 15%; border-radius: 0 4px 4px 0;"></div>
                            <h3 class="fw-bold mb-4" style="color: #FFD700;">4. Community Initiatives</h3>
                            <p class="text-light mb-0" style="font-size: 1.05rem; line-height: 1.7; opacity: 0.9;">
                                We believe in the power of community to foster change. BootleLink supports local initiatives and partnerships with NGOs that advocate for safer drinking environments and alcohol harm reduction.
                            </p>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer p-4 text-center" style="background-color: #252525; border-top: 1px solid rgba(255,255,255,0.1);">
                        {{-- <p class="text-light mb-3">Last updated: May 4, 2025</p> --}}
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
