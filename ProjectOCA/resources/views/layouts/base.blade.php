<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

@include('partials.head')

<body>

@include("partials.header")

<main>
    @yield('main')
</main>

@include("partials.footer")

</body>


</html>
