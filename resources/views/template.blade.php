<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Consulta comprobantes electronicos" />
    <meta name="author" content="OBSolucionesCR" />
    <title>OBSoluciones @yield('title')</title>

    <!-- Font Awesome icons -->
    <script src="https://kit.fontawesome.com/09f2fe68c8.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template.css') }}" rel="stylesheet" />
    @stack('css')
</head>

<body id="page-top">
    <!-- Navigation-->
    <x-navigation-header />

    <main role="main">
        @yield('content')
    </main>

    <!-- footer-->
    <x-footer />

    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    @stack('js')
</body>

</html>
