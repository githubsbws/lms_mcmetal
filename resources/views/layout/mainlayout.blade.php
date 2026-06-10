<!DOCTYPE html>

<html lang="en">

<head>

    @include('layout.partials.head')

</head>

<body>


    @include('layout.partials.headerscript')

    @yield('content')

    @include('layout.partials.footer')

    @include('layout.partials.footerscript')

</body>

</html>