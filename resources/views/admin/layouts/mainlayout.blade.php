<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('admin.layouts.partials.head')

</head>

<body>
    @if (!View::hasSection('hidesidebar'))
        @include('admin.layouts.partials.menu-left')
    @endif
    
    @yield('content')


    <div id="footer" class="hidden-print">

        <!--  Copyright Line -->
        <div class="copy">© 2023 - All Rights Reserved.</a></div>
        <!--  End Copyright Line -->

    </div>
</body>

</html>