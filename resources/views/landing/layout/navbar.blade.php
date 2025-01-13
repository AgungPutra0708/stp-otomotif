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
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="{{ route('product') }}"
                    class="nav-item nav-link {{ Route::is('product') ? 'active' : '' }}">Product</a>
                <a href="service.html" class="nav-item nav-link">Service</a>
                <a href="service.html" class="nav-item nav-link">Information Center</a>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
                <a href="" class="nav-item nav-link bg-primary text-white px-5 ms-3 d-none d-lg-block">Cart</a>
            </div>
        </div>
    </nav>
</div>
