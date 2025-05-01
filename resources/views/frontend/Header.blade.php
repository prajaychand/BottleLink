<nav class="navbar navbar-expand-lg fixed-top" id="bottlelink-navbar">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <span class="brand-text">Bottle<span class="brand-accent">link</span></span>
            <i class="fas fa-wine-bottle brand-icon"></i>
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">

                <!-- Search Bar -->
                <li class="nav-item search-item">
                    <form class="search-form" action="{{ url('/search') }}" method="GET">
                        <div class="input-group" style="height: 3rem">
                            <input class="form-control search-input" type="search" name="query" placeholder="Search premium drinks..." required>
                            <button class="btn search-btn" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </li>

                <!-- Gallery Link -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('gallery') }}">
                        <i class="fas fa-th me-1"></i>Gallery
                    </a>
                </li>

                <!-- Cart Icon -->
                <li class="nav-item">
                    <a class="nav-link cart-link" href="{{ url('/cart') }}">
                        <i class="fas fa-shopping-bag"></i>
                        @if($cartCount > 0)
                            <span class="cart-badge">{{$cartCount}}</span>
                        @endif
                    </a>
                </li>

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i>Login</a></li>
                    <li class="nav-item">
                        <a class="nav-link register-btn" href="{{ route('register') }}"><i class="fas fa-user-plus me-1"></i>Register</a>
                    </li>
                @else
                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle user-dropdown" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <span class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            <span class="d-none d-md-inline ms-2">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ url('/profile') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="{{ url('/orders') }}"><i class="fas fa-receipt me-2"></i>Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('post') }}"><i class="fas fa-pen-fancy me-2"></i>Posts</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>




<script>
    // Add scrolled class to navbar when scrolling
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('bottlelink-navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
    });
</script>