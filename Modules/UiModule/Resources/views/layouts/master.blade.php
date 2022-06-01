<!DOCTYPE html>
<html lang="en">
    <head>
        @include('uimodule::common.css')
    </head>
    <body>
    @include('uimodule::common.header')
        @yield('content')
    @include('uimodule::common.footer')
    @include('uimodule::common.js')
    @yield('js')
    </body>
</html>
