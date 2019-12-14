<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>{{ config('app.name', 'Simulation') }}  @yield('title')</title>

    <link href="{{ asset('css/template.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

    @yield('styles')

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">

    @include('admin.layouts._navbar')

    <div class="app-body">
        @include('admin.layouts._sidebar')

        @if (Session::has('message'))
            <script>
                var type = "{!! Session::get('alert-type', 'info') !!}"
                var message = "{{ Session::get('message') }}"
                notification(type, message)
            </script>
        @endif

        <!-- Contenido Principal -->
        <main class="main">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

            <div class="container-fluid">
                @yield('content')
            </div>
        </main>
    </div>


    <footer class="app-footer">
        <span><a href="#">UMSS</a> &copy; 2019</span>
        <span class="ml-auto">Desarrollado por <a href="#">carlosveizaga.jcvc@gmail.com</a></span>
    </footer>

    <script src="{{ asset('js/template.js') }}" type="text/javascript"></script>
    
    @yield('scripts')

</body>
</html>