@extends('admin.layout')

@section('content')
    <x-app-layout>
        <main id="main" class="main">
            <div class="container mt-4">
                <h1 class="mb-4 text-center">Order #{{ $order->id }} Details</h1>

                <div class="mb-4">
                    <strong>User:</strong> {{ $order->user->name ?? 'Guest' }} <br>
                    <strong>Total:</strong> Rs.{{ number_format($order->total_price, 2) }} <br>
                    <strong>Status:</strong>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('PATCH')
                        <select name="payment_status" onchange="this.form.submit()" class="form-select d-inline w-auto">
                            <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->payment_status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->payment_status === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Drink</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->drink->name }}</td>
                                    <td>
                                        <img src="{{ asset($item->drink->image_path) }}" width="80" class="img-thumbnail">
                                    </td>
                                    <td>Rs.{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rs.{{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </x-app-layout>
@endsection
