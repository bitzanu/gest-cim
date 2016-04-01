<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <title>Urbis-Serv Gestiune Cimitire</title>
    <meta name="description" content="Aplicatie pentru gestiune cimitire">
     <link rel="stylesheet" href="{{ asset('assets/css/print.css') }}">
     <h1>Urbis-Serv SRL Buzau</h1>
     @yield('header')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
<footer>
    @yield('footer')
</footer>
</html>