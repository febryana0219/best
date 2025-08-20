<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ricwil Indonesia - {{ $metaTitle }}</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('assets/admin/img/favicon/favicon.ico') }}" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="{{ !empty($metaDescription) ? $metaDescription : '' }}">
    <meta name="keywords" content="{{ !empty($metaKeyword) ? $metaKeyword : '' }}">
    <meta name="author" content="Ricwil Indonesia" />

    @include('user.layouts.head')
</head>

<body>
    @include('user.layouts.preloader')
    @include('user.layouts.navbar-menu')

    @yield('content')

    @include('user.layouts.footer')
    @include('user.layouts.mobile-nav')
    @include('user.layouts.search-popup')
    @include('user.layouts.scripts')
</body>

</html>
