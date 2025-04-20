@extends('frontend.Master')

@section('content')
    <main id="main" class="main py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header bg-white py-3 border-bottom">
                            <h1 class="h3 mb-0 text-center fw-bold">Your Order History</h1>
                        </div>
                        
                        <div class="card-body p-0 p-md-3">
                            @if(count($orders) > 0)
                                <!-- Desktop view - Table -->
                                <div class="table-responsive d-none d-md-block">
                                    <table class="table table-hover align-middle">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="py-3">Order ID</th>
                                                <th class="py-3">User</th>
                                                <th class="py-3 text-end">Total</th>
                                                <th class="py-3 text-center">Status</th>
                                                <th class="py-3">Placed At</th>
                                                <th class="py-3 text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $order)
                                                <tr class="order-row">
                                                    <td class="py-3 fw-medium">#{{ $order->id }}</td>
                                                    <td class="py-3">{{ $order->user->name ?? 'Guest' }}</td>
                                                    <td class="py-3 text-end fw-bold">Rs.{{ number_format($order->total_price, 2) }}</td>
                                                    <td class="py-3 text-center">
                                                        <span class="badge rounded-pill px-3 py-2 
                                                            @if($order->payment_status === 'completed') bg-success
                                                            @elseif($order->payment_status === 'processing') bg-primary
                                                            @elseif($order->payment_status === 'cancelled') bg-danger
                                                            @else bg-warning @endif">
                                                            {{ ucfirst($order->payment_status) }}
                                                        </span>
                                                    </td>
                                                    <td class="py-3">{{ $order->created_at->format('M d, Y') }}<br><small class="text-muted">{{ $order->created_at->format('h:i A') }}</small></td>
                                                    <td class="py-3 text-center">
                                                        
                                                        @if($order->payment_status === 'pending')
                                                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="d-inline-block">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this order?');">
                                                                    <i class="fas fa-times me-1"></i> Cancel
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- Mobile view - Cards -->
                                <div class="d-md-none">
                                    @foreach($orders as $order)
                                        <div class="card mb-3 border order-card">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                                <span class="fw-bold">Order #{{ $order->id }}</span>
                                                <span class="badge rounded-pill px-3 py-2 
                                                    @if($order->payment_status === 'completed') bg-success
                                                    @elseif($order->payment_status === 'processing') bg-primary
                                                    @elseif($order->payment_status === 'cancelled') bg-danger
                                                    @else bg-warning @endif">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            </div>
                                            <div class="card-body py-3">
                                                <div class="row mb-2">
                                                    <div class="col-6 text-muted">User:</div>
                                                    <div class="col-6 text-end">{{ $order->user->name ?? 'Guest' }}</div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-6 text-muted">Total:</div>
                                                    <div class="col-6 text-end fw-bold">Rs.{{ number_format($order->total_price, 2) }}</div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-6 text-muted">Date:</div>
                                                    <div class="col-6 text-end">{{ $order->created_at->format('M d, Y') }}</div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-6 text-muted">Time:</div>
                                                    <div class="col-6 text-end">{{ $order->created_at->format('h:i A') }}</div>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    
                                                    @if($order->payment_status === 'pending')
                                                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this order?');">
                                                                <i class="fas fa-times me-1"></i> Cancel
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <div class="mb-3">
                                        <i class="fas fa-shopping-bag fa-4x text-muted"></i>
                                    </div>
                                    <h4 class="mb-3">No Orders Found</h4>
                                    <p class="text-muted mb-4">You haven't placed any orders yet.</p>
                                    
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <style>
        .order-row {
            transition: all 0.3s ease;
        }
        
        .order-row:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
        
        .order-card {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            overflow: hidden;
        }
        
        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .badge {
            font-weight: 500;
            letter-spacing: 0.3px;
        }
        
        .bg-success {
            background-color: #06d6a0 !important;
        }
        
        .bg-primary {
            background-color: #4361ee !important;
        }
        
        .bg-warning {
            background-color: #ffbe0b !important;
        }
        
        .bg-danger {
            background-color: #ef476f !important;
        }
        
        .btn-outline-primary {
            color: #4361ee;
            border-color: #4361ee;
        }
        
        .btn-outline-primary:hover {
            background-color: #4361ee;
            border-color: #4361ee;
        }
        
        .btn-outline-danger {
            color: #ef476f;
            border-color: #ef476f;
        }
        
        .btn-outline-danger:hover {
            background-color: #ef476f;
            border-color: #ef476f;
        }
        
        @media (max-width: 767.98px) {
            .main {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
        }
    </style>
@endsection