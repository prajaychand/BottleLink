@extends('frontend.Master')
@section('content')
    <section class="confirmation-section py-5">
        <div class="container py-3">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="card border-0 shadow-sm rounded-3 text-center mb-4 confirmation-card">
                        <div class="card-header bg-white py-4 border-bottom">
                            <div class="success-icon mb-3">
                                <i class="fas fa-check-circle fa-3x text-success"></i>
                            </div>
                            <h4 class="mb-0 fw-bold">Order Confirmed!</h4>
                        </div>
                        <div class="card-body py-5">
                            <h5 class="card-title fw-bold mb-4">Thank you for your order!</h5>
                            
                            <div class="order-details p-4 mb-4 mx-auto" style="max-width: 400px;">
                                <div class="order-number mb-3 p-3 rounded bg-light">
                                    <p class="mb-1 text-muted small">ORDER NUMBER</p>
                                    <h5 class="mb-0 fw-bold">#{{ $order->id }}</h5>
                                </div>
                                
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">Total Cost:</span>
                                    <span class="fw-bold">Rs. {{ number_format($order->total_price, 2) }}</span>
                                </div>
                                
                                <div class="d-flex justify-content-between py-2">
                                    <span class="text-muted">Payment Status:</span>
                                    <span class="fw-bold 
                                        @if($order->payment_status == 'paid') text-success 
                                        @elseif($order->payment_status == 'pending') text-warning 
                                        @else text-danger @endif">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </div>
                            </div>
                            
                            <p class="mb-4 text-muted">
                                A confirmation email has been sent to your email address.
                            </p>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="{{ route('home') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill">
                                    <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                                </a>
                                <a href="{{ route('orders.index') }}" class="btn btn-outline-primary btn-lg px-5 py-3 rounded-pill">
                                    <i class="fas fa-list me-2"></i>View Orders
                                </a>
                            </div>
                        </div>
                        <div class="card-footer bg-white py-4 border-top">
                            <div class="row justify-content-center">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-truck text-primary me-3 fa-2x"></i>
                                        <div class="text-start">
                                            <h6 class="mb-0 fw-bold">Free Shipping</h6>
                                            <p class="mb-0 small text-muted">On all orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .confirmation-section {
            background-color: #f8f9fa;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }
        
        .confirmation-card {
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .confirmation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }
        
        .success-icon {
            animation: pulse 2s infinite;
        }
        
        .order-details {
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }
        
        .btn-primary {
            background-color: #4361ee;
            border-color: #4361ee;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #3a56d4;
            border-color: #3a56d4;
            transform: translateY(-2px);
        }
        
        .btn-outline-primary {
            color: #4361ee;
            border-color: #4361ee;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            background-color: #4361ee;
            border-color: #4361ee;
            transform: translateY(-2px);
        }
        
        .text-success {
            color: #06d6a0 !important;
        }
        
        .text-warning {
            color: #ffbe0b !important;
        }
        
        .text-danger {
            color: #ef476f !important;
        }
        
        .text-primary {
            color: #4361ee !important;
        }
        
        .rounded-pill {
            border-radius: 50rem !important;
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        @media (max-width: 767.98px) {
            .confirmation-card:hover {
                transform: none;
            }
            
            .d-md-flex {
                display: block !important;
            }
            
            .btn {
                margin-bottom: 0.5rem;
            }
        }
    </style>
@endsection