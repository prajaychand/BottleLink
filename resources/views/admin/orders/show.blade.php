@extends('admin.layout')

@section('content')
    <x-app-layout>
        <main id="main" class="main">
            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card shadow-sm border-0 rounded-lg mb-4">
                            <div class="card-header bg-primary text-white py-3">
                                <h1 class="mb-0 text-center fs-4 fw-bold">Order #{{ $order->id }} Details</h1>
                            </div>
                            
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="card h-100 border-0 bg-light">
                                            <div class="card-body">
                                                <h5 class="card-title fw-bold mb-3">Order Information</h5>
                                                <div class="mb-2">
                                                    <span class="text-muted">Customer:</span>
                                                    <span class="fw-medium ms-2">{{ $order->user->name ?? 'Guest' }}</span>
                                                </div>
                                                <div class="mb-2">
                                                    <span class="text-muted">Order Date:</span>
                                                    <span class="fw-medium ms-2">{{ $order->created_at->format('F d, Y') }}</span>
                                                </div>
                                                <div class="mb-2">
                                                    <span class="text-muted">Order Time:</span>
                                                    <span class="fw-medium ms-2">{{ $order->created_at->format('h:i A') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mt-3 mt-md-0">
                                        <div class="card h-100 border-0 bg-light">
                                            <div class="card-body">
                                                <h5 class="card-title fw-bold mb-3">Payment Details</h5>
                                                <div class="mb-2">
                                                    <span class="text-muted">Total Amount:</span>
                                                    <span class="fw-bold ms-2 fs-5">Rs.{{ number_format($order->total_price, 2) }}</span>
                                                </div>
                                                <div class="mb-2">
                                                    <span class="text-muted">Status:</span>
                                                    <div class="d-inline-block ms-2">
                                                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-inline-block">
                                                            @csrf
                                                            @method('PATCH')
                                                            <select name="payment_status" onchange="this.form.submit()" class="form-select form-select-sm d-inline-block" style="width: auto; min-width: 150px;">
                                                                <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                                <option value="processing" {{ $order->payment_status === 'processing' ? 'selected' : '' }}>Processing</option>
                                                                <option value="completed" {{ $order->payment_status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                            </select>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="fw-bold mb-3">Order Items</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="py-3 ps-3 fw-semibold text-dark">Drink</th>
                                                <th class="py-3 fw-semibold text-dark text-center">Image</th>
                                                <th class="py-3 fw-semibold text-dark">Price</th>
                                                <th class="py-3 fw-semibold text-dark text-center">Quantity</th>
                                                <th class="py-3 pe-3 fw-semibold text-dark text-end">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->items as $item)
                                                <tr class="border-bottom">
                                                    <td class="ps-3 fw-medium">{{ $item->drink->name }}</td>
                                                    <td class="text-center">
                                                        <img src="{{ asset($item->drink->image_path) }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                                    </td>
                                                    <td>Rs.{{ number_format($item->price, 2) }}</td>
                                                    <td class="text-center">
                                                        <span class="badge bg-secondary rounded-pill px-3 py-2">{{ $item->quantity }}</span>
                                                    </td>
                                                    <td class="pe-3 fw-bold text-end">Rs.{{ number_format($item->price * $item->quantity, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="bg-light">
                                            <tr>
                                                <td colspan="4" class="text-end fw-bold pe-3 py-3">Total:</td>
                                                <td class="pe-3 fw-bold text-end py-3 fs-5">Rs.{{ number_format($order->total_price, 2) }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                
                                <div class="mt-4 text-end">
                                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary me-2">
                                        Back to Orders
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </x-app-layout>
@endsection