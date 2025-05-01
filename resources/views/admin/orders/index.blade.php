@extends('admin.layout')

@section('content')
    <x-app-layout>
        <main id="main" class="main">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card shadow-sm border-0 rounded-lg mb-5">
                            <div class="card-header bg-primary text-white py-3">
                                <h1 class="mb-0 text-center fs-4 fw-bold">All Orders</h1>
                            </div>
                            
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="py-3 ps-4 fw-semibold text-dark">Order ID</th>
                                                <th class="py-3 fw-semibold text-dark">User</th>
                                                <th class="py-3 fw-semibold text-dark">Total</th>
                                                <th class="py-3 fw-semibold text-dark">Contact</th>
                                                <th class="py-3 fw-semibold text-dark">Status</th>
                                                <th class="py-3 fw-semibold text-dark">Placed At</th>
                                                <th class="py-3 pe-4 fw-semibold text-dark text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $order)
                                                <tr class="border-bottom">
                                                    <td class="ps-4 fw-medium">#{{ $order->id }}</td>
                                                    <td>{{ $order->user->name ?? 'Guest' }}</td>
                                                    <td class="fw-medium">Rs.{{ number_format($order->total_price, 2) }}</td>
                                                    <td class="fw-medium">{{ $order->user->phone }}</td>

                                                    <td>
                                                        @php
                                                            $statusClass = [
                                                                'pending' => 'bg-warning',
                                                                'paid' => 'bg-success',
                                                                'failed' => 'bg-danger',
                                                                'processing' => 'bg-info',
                                                                'completed' => 'bg-primary',
                                                            ][$order->payment_status] ?? 'bg-secondary';
                                                        @endphp
                                                        <span class="badge {{ $statusClass }} rounded-pill px-3 py-2">
                                                            {{ ucfirst($order->payment_status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                                    <td class="text-center pe-4">
                                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm px-3 rounded-pill">
                                                            View Details
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </x-app-layout>
@endsection