<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="STP Otomotif">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- Title Page-->
    <title>@yield('title', 'Dashboard')</title>

    @include('admin.layout.css')

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        @include('admin.layout.header-mobile')
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        @include('admin.layout.sidebar')
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            @include('admin.layout.header-desktop')
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    @yield('content-admin')
                </div>
            </div>
            <!-- MAIN CONTENT-->
        </div>

    </div>

    @include('admin.layout.script')

</body>

</html>
<!-- end document-->
