@extends('frontend.Master')

@section('content')
    <!-- Hero Slider Section with Premium Design -->
    <div class="hero-section mb-5">
        <div class="swiper mySwiper premium-slider">
            <div class="swiper-wrapper">
                @foreach($images as $image)
                    <div class="swiper-slide">
                        <div class="slide-inner" style="background-image: url('{{ asset($image->image_path) }}');">
                            <div class="slide-content container">
                                <div class="slide-text-box">
                                    <h2 class="slide-title">Premium Craft Beverages</h2>
                                    <p class="slide-subtitle">Discover exceptional taste in every sip</p>
                                    <a href="#categories" class="btn btn-explore">Explore Collection</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    
    <!-- Enhanced Shop by Drinks Section -->
    <section id="categories" class="premium-categories py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title">SHOP BY DRINKS</h2>
                <div class="title-separator">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            
            <div class="row g-4">
                @foreach($Category as $item)
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="{{ route('drinks',$item->id)}}" class="text-decoration-none">
                        <div class="premium-card">
                            <div class="card-image-wrapper">
                                <div class="card-image" style="background-image: url('{{ asset('storage/'.$item->image_path) }}');">
                                    <div class="card-overlay"></div>
                                </div>
                                
                            </div>
                            <div class="card-content">
                                <h3 class="card-title">{{$item->name}}</h3>
                                <p class="card-description">Explore our premium selection of {{$item->name}}</p>
                                <div class="card-action">
                                    <span class="action-text">View Collection</span>
<span class="btn btn-light btn-sm rounded-circle shadow-sm">
    <i class="fas fa-arrow-right"></i>
</span>                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>      
        
        /* Hero Slider Section */
        .hero-section {
            margin-top: 5rem;
        }
        
        .premium-slider {
            height: 70vh;
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
            border-radius: 0;
            overflow: hidden;
        }
        
        .slide-inner {
            height: 70vh;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .slide-inner:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);
        }
        
        .slide-content {
            position: relative;
            z-index: 2;
            padding: 0 3rem;
        }
        
        .slide-text-box {
            max-width: 600px;
            color: #fff;
            animation: fadeInUp 1s ease;
        }
        
        .slide-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        
        .slide-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .btn-explore {
            background-color: #fff;
            color: #222;
            border: none;
            padding: 0.8rem 2rem;
            font-weight: 600;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .btn-explore:hover {
            background-color: #222;
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        
        /* Swiper Navigation */
        .swiper-button-next, 
        .swiper-button-prev {
            width: 50px !important;
            height: 50px !important;
            background-color: rgba(255,255,255,0.9);
            border-radius: 50%;
            color: #222 !important;
            transition: all 0.3s ease;
        }
        
        .swiper-button-next:after, 
        .swiper-button-prev:after {
            font-size: 20px !important;
            font-weight: bold;
        }
        
        .swiper-button-next:hover, 
        .swiper-button-prev:hover {
            background-color: #fff;
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background-color: rgba(255,255,255,0.7);
            opacity: 1;
        }
        
        .swiper-pagination-bullet-active {
            background-color: #fff;
            transform: scale(1.2);
        }
        
        /* Section Styling */
        .premium-categories {
            padding: 5rem 0;
        }
        
        .section-header {
            margin-bottom: 3rem;
        }
        
        .section-subtitle {
            display: block;
            color: #777;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 0.5rem;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
            color: #222;
        }
        
        .title-separator {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 1.5rem;
        }
        
        .title-separator span {
            display: block;
            height: 4px;
            background-color: #222;
        }
        
        .title-separator span:nth-child(1),
        .title-separator span:nth-child(3) {
            width: 30px;
        }
        
        .title-separator span:nth-child(2) {
            width: 60px;
        }
        
        /* Premium Card Styling */
        .premium-card {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background-color: #fff;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .premium-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        
        .card-image-wrapper {
            position: relative;
            height: 250px;
            overflow: hidden;
        }
        
        .card-image {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            transition: transform 0.7s ease;
        }
        
        .premium-card:hover .card-image {
            transform: scale(1.1);
        }
        
        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0,0,0,0.6), rgba(0,0,0,0));
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }
        
        .premium-card:hover .card-overlay {
            opacity: 0.4;
        }
        
        .card-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            z-index: 2;
            transition: all 0.3s ease;
        }
        
        .card-badge i {
            font-size: 1.5rem;
            color: #222;
            transition: all 0.3s ease;
        }
        
        .premium-card:hover .card-badge {
            transform: rotate(25deg);
            background-color: #222;
        }
        
        .premium-card:hover .card-badge i {
            color: #fff;
        }
        
        .card-content {
            padding: 2rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
            color: #222;
            position: relative;
            display: inline-block;
        }
        
        .card-title:after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: #222;
            transition: width 0.3s ease;
        }
        
        .premium-card:hover .card-title:after {
            width: 100%;
        }
        
        .card-description {
            color: #777;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        .card-action {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }
        
        .action-text {
            font-weight: 600;
            color: #222;
            font-size: 0.95rem;
            transition: color 0.3s ease;
        }
        
        .action-icon {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        .action-icon i {
            transition: transform 0.3s ease;
        }
        
        .premium-card:hover .action-text {
            color: #000;
        }
        
        .premium-card:hover .action-icon {
            background-color: #222;
            color: #fff;
        }
        
        .premium-card:hover .action-icon i {
            transform: translateX(3px);
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .slide-title {
                font-size: 3rem;
            }
        }
        
        @media (max-width: 992px) {
            .premium-slider, .slide-inner {
                height: 60vh;
            }
            
            .slide-title {
                font-size: 2.5rem;
            }
            
            .section-title {
                font-size: 2.2rem;
            }
        }
        
        @media (max-width: 768px) {
            .premium-slider, .slide-inner {
                height: 50vh;
            }
            
            .slide-title {
                font-size: 2rem;
            }
            
            .slide-subtitle {
                font-size: 1rem;
            }
            
            .btn-explore {
                padding: 0.7rem 1.5rem;
                font-size: 0.9rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .card-image-wrapper {
                height: 220px;
            }
            
            .card-content {
                padding: 1.5rem;
            }
        }
        
        @media (max-width: 576px) {
            .premium-slider, .slide-inner {
                height: 40vh;
            }
            
            .slide-content {
                padding: 0 1.5rem;
            }
            
            .slide-title {
                font-size: 1.8rem;
                margin-bottom: 0.5rem;
            }
            
            .slide-subtitle {
                font-size: 0.9rem;
                margin-bottom: 1.5rem;
            }
            
            .btn-explore {
                padding: 0.6rem 1.2rem;
                font-size: 0.8rem;
            }
            
            .swiper-button-next, 
            .swiper-button-prev {
                width: 40px !important;
                height: 40px !important;
            }
            
            .swiper-button-next:after, 
            .swiper-button-prev:after {
                font-size: 16px !important;
            }
            
            .section-subtitle {
                font-size: 0.8rem;
                letter-spacing: 2px;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .card-image-wrapper {
                height: 200px;
            }
            
            .card-badge {
                width: 40px;
                height: 40px;
                top: 15px;
                right: 15px;
            }
            
            .card-badge i {
                font-size: 1.2rem;
            }
            
            .card-content {
                padding: 1.2rem;
            }
            
            .card-title {
                font-size: 1.3rem;
            }
            
            .card-description {
                font-size: 0.85rem;
                margin-bottom: 1rem;
            }
        }
    </style>
@endsection