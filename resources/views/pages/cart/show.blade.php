@extends('frontend.Master')

@section('content')

<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 mb-4">
                <h2 class="fw-bold mb-4 text-center text-md-start">Your Shopping Cart</h2>

                @if(count($cartItems) > 0)
                    <div class="card shadow-sm border-0 rounded-3 mb-4">
                        <div class="card-header bg-white py-3 border-bottom border-light">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Cart Items ({{ count($cartItems) }})
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            @foreach($cartItems as $item)
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-md-3 col-sm-12 mb-4 mb-md-0">
                                        <div class="bg-image hover-overlay rounded-3 overflow-hidden shadow-sm">
                                            <img src="{{ asset($item->drink->image_path) }}" class="img-fluid" alt="{{ $item->drink->name }}" />
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-5 col-md-5 col-sm-12 mb-4 mb-md-0">
                                        <h5 class="fw-bold">{{ $item->drink->name }}</h5>
                                        <p class="text-muted mb-2">Price: <span class="fw-bold text-dark">Rs. {{ number_format($item->drink->price, 2) }}</span></p>
                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                onclick="event.preventDefault(); document.getElementById('remove-item-{{ $item->id }}').submit();">
                                            <i class="fas fa-trash me-1"></i> Remove
                                        </button>
                                        <form id="remove-item-{{ $item->id }}" action="{{ route('cart.remove', $item->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-md-end">
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center mb-3 mb-md-0">
                                                @csrf
                                                @method('PUT')
                                                <div class="input-group input-group-sm" style="width: 120px;">
                                                    <button class="btn btn-primary" type="button"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown(); this.form.submit();">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                                           class="form-control text-center border-primary"
                                                           onchange="this.form.submit()" />
                                                    <button class="btn btn-primary" type="button"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp(); this.form.submit();">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </form>
                                            <div class="ms-md-3 mt-2 mt-md-0">
                                                <span class="badge bg-primary rounded-pill p-2 fs-6">
                                                    Rs. {{ number_format($item->drink->price * $item->quantity, 2) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                    <hr class="my-4" />
                                @endif
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning shadow-sm rounded-3 border-0" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle me-2 fs-4"></i>
                            <div>
                                <h5 class="mb-1">Your cart is empty</h5>
                                <p class="mb-0">Please add some items to your cart to continue shopping.</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-bag me-2"></i> Continue Shopping
                        </a>
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                @if(count($cartItems) > 0)
                    <div class="card shadow-sm border-0 rounded-3 mb-4 sticky-md-top" style="top: 20px;">
                        <div class="card-header bg-primary text-white py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-receipt me-2"></i>
                                Order Summary
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-bottom">
                                    <div>
                                        <h6 class="mb-0">Subtotal</h6>
                                        <small class="text-muted">{{ count($cartItems) }} items</small>
                                    </div>
                                    <span>Rs. {{ number_format($cartItems->sum(fn($item) => $item->drink->price * $item->quantity), 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0 border-bottom">
                                    <div>
                                        <h6 class="mb-0">Shipping</h6>
                                        <small class="text-muted">Standard delivery</small>
                                    </div>
                                    <span class="text-success">Free</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0 pt-3">
                                    <h5 class="fw-bold mb-0">Total</h5>
                                    <span class="fw-bold fs-5">Rs. {{ number_format($cartItems->sum(fn($item) => $item->drink->price * $item->quantity), 2) }}</span>
                                </li>
                            </ul>

                            <form id="khalti-payment-form">
                                @csrf
                                <input type="hidden" name="delivery_address" value="Default Address" />
                                <input type="hidden" name="latitude" value="27.7172" />
                                <input type="hidden" name="longitude" value="85.3240" />
                                <input type="hidden" name="amount" value="{{ $cartItems->sum(fn($item) => $item->drink->price * $item->quantity) }}" />
                                <input type="hidden" name="name" value="Order by {{ auth()->user()->name }}" />
                                <input type="hidden" name="user" value="{{ auth()->user()->id }}" />

                                <button type="submit" id="khalti-btn" class="btn btn-primary btn-lg w-100 rounded-3 shadow-sm">
                                    <i class="fas fa-credit-card me-2"></i> Proceed to Checkout
                                </button>
                            </form>

                            <div class="mt-3 text-center">
                                <a href="{{ route('home') }}" class="text-decoration-none">
                                    <i class="fas fa-arrow-left me-1"></i> Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('khalti-payment-form').addEventListener('submit', async function (e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);
        const submitBtn = document.getElementById('khalti-btn');
        submitBtn.disabled = true;
        submitBtn.innerText = "Processing...";

        try {
            // Step 1: Create the order
            const createOrderRes = await fetch("{{ route('checkout') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                },
                body: formData
            });

            const orderData = await createOrderRes.json();

            if (!orderData.success || !orderData.order_id) {
                alert("Failed to create order.");
                submitBtn.disabled = false;
                submitBtn.innerText = "Proceed to Checkout";
                return;
            }

            // Step 2: Add service_id to form data and initiate Khalti payment
            formData.append('service_id', orderData.order_id);

            const khaltiRes = await fetch("{{ route('khalti.purchase') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                },
                body: formData
            });

            const paymentData = await khaltiRes.json();

            if (paymentData.payment_url) {
                window.location.href = paymentData.payment_url;
            } else {
                alert("Failed to initiate payment.");
                submitBtn.disabled = false;
                submitBtn.innerText = "Proceed to Checkout";
            }

        } catch (error) {
            console.error(error);
            alert("Something went wrong.");
            submitBtn.disabled = false;
            submitBtn.innerText = "Proceed to Checkout";
        }
    });
</script>

@endsection
