<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Code Editora') }}</title>

    <!-- Styles -->
    <link href="/css/store.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'userId' => Auth::check() ? Auth::user()->id : null
        ]); ?>
    </script>
</head>
<body>
<div id="app">

    @include('layouts._navigation_links')

    @yield('banner')
    @yield('menu')

    <section>
        @yield('content')
    </section>
</div>

<footer class="text-center">
    <p>@ CodePub {{date('Y')}}</p>
</footer>


<!-- Scripts -->
<script src="/js/app.js"></script>
@stack('scripts')
</body>
</html>
