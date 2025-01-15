<div class="container-fluid sticky-top bg-dark bg-light-radial shadow-sm px-5 pe-lg-0">
    <nav class="navbar navbar-expand-lg bg-dark bg-light-radial navbar-dark py-3 py-lg-0">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img class="img-fluid" src="{{ asset('assets-admin/images/logo.png') }}" alt="STP OTOMOTIF"
                style="max-height: 50px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('home') }}" class="nav-item nav-link {{ Route::is('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}"
                    class="nav-item nav-link {{ Route::is('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('product') }}"
                    class="nav-item nav-link {{ Route::is('product.*') ? 'active' : '' }}">Product</a>
                <a href="{{ route('service') }}"
                    class="nav-item nav-link {{ Route::is('service.*') ? 'active' : '' }}">Service</a>
                <a href="{{ route('info') }}"
                    class="nav-item nav-link {{ Route::is('info') ? 'active' : '' }}">Information</a>
                <a href="{{ route('contact') }}"
                    class="nav-item nav-link {{ Route::is('contact') ? 'active' : '' }}">Contact</a>

                @auth
                    <!-- Tampilkan jika user sudah login -->
                    <a href="{{ route('cart') }}"
                        class="nav-item nav-link text-white btn btn-primary px-4 d-none d-lg-block">Cart</a>
                    <!-- Tombol Logout -->
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit"
                            class="nav-item nav-link btn btn-danger text-white px-4 d-none d-lg-block">Logout</button>
                    </form>
                @endauth

                @guest
                    <!-- Tampilkan jika user belum login -->
                    <a href="{{ route('login') }}"
                        class="nav-item nav-link text-white btn btn-primary px-4 d-none d-lg-block">Login</a>
                @endguest
            </div>
        </div>
    </nav>
</div>
