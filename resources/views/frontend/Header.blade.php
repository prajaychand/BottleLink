<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">Bottlelink</a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto text-dark">

                <!-- Search Bar -->
                <li class="nav-item">
                    <form class="d-flex" action="{{ url('/search') }}" method="GET">
                        <input class="form-control me-2" type="search" name="query" placeholder="Search products..." required>
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </li>

                <!-- Gallery Link (NEW) -->
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{route('gallery') }}">Gallery</a>
                </li>

                <!-- Cart Icon -->
                <li class="nav-item">
                    <a class="nav-link position-relative text-dark" href="{{ url('/cart') }}">
                        🛒 Cart <span id="cart-count" class="badge bg-danger">{{$cartCount}}</span>
                    </a>
                </li>

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item"><a class="nav-link text-dark" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="{{ route('register') }}">Register</a></li>
                @else
                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/profile') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ url('/orders') }}">Orders</a></li>
                            <li><a class="dropdown-item" href="{{route('post')}}">Posts</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
