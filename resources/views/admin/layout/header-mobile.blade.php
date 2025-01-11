<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="index.html">
                    <img src="{{ asset('assets-admin/images/logo.png') }}" alt="STP OTOMOTIF"
                        style="width: 65%!important; float:left!important;" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="{{ Route::is('products.*') ? 'active' : '' }}">
                    <a href="{{ route('products.index') }}">
                        <i class="fa fa-list"></i>Products</a>
                </li>
                <li class="{{ Route::is('services.*') ? 'active' : '' }}">
                    <a href="{{ route('services.index') }}">
                        <i class="fa fa-wrench"></i>Services</a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fa fa-usd"></i>Sales</a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fa fa-users"></i>Team</a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fa fa-newspaper"></i>News</a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fa fa-comments"></i>Testimony</a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fa fa-comment"></i>Message</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
