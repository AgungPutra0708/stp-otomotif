<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="STP Otomotif">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- Title Page-->
    <title>@yield('title', 'Login')</title>

    @include('admin.layout.css')

</head>

<body class="animsition">
    @yield('content-auth')

    @include('admin.layout.script')

</body>

</html>
<!-- end document-->
