<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('assets-admin/images/logo.png') }}" alt="STP OTOMOTIF" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
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
        </nav>
    </div>
</aside>
