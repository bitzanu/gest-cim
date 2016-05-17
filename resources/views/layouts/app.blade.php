<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>URBIS-SERV</title>

    <!-- Fonts -->
    {!! HTML::style('css/app.css')!!}
    {!! HTML::style('css/vendor/bootstrap-datetimepicker.min.css')!!}
    {!! HTML::style('bootstrap/css/bootstrap.min.css')!!}

     <!-- ... -->
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Urbis-Serv
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                 @if (Auth::guest())
                 @else
                    <li><a class="btn btn-info" href="{{ url('/home') }} " >Home</a></li>
                    <li><a  class="btn btn-info" href="{{ url('cimitire') }}">Cimitire</a></li>
                    <li><a class="btn btn-info" href="{{ url('parcele') }}">Parcele</a></li>
                     <li><a class="btn btn-info" href="{{ url('locuri') }}">Locuri</a></li>
                     <li><a  class="btn btn-info" href="{{ url('persoane') }}">Persoane</a></li>
                     <li><a  class="btn btn-info" href="{{ url('concesiuni') }}">Concesiuni</a></li>
                     <li><a  class="btn btn-info" href="{{ url('rate') }}">Rate</a></li>
                     <li><a  class="btn btn-info" href="{{ url('plati') }}">Plati</a></li>

                     @if (Auth::user()->admin)
                     <li><a class="btn btn-info" href="{{ url('admin') }}">Admin</a></li>
                     <li><a  class="btn btn-info" href="{{ url('tipuri') }}">Tipuri</a></li>
                     <li><a  class="btn btn-info" href="{{ url('tarife') }}">Tarife</a></li>
                     @endif
                @endif
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a class="btn btn-info" href="{{ url('/login') }}">Login</a></li>
                        <li><a class="btn btn-info" href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    <!-- JavaScripts -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    {!! HTML::script('js/vendor/jquery.min.js')!!}
    {!! HTML::script('js/vendor/bootstrap.min.js')!!}
    {!! HTML::script('js/vendor/moment.min.js')!!}
    {!! HTML::script('js/vendor/bootstrap-datetimepicker.min.js')!!}
    {!! HTML::script('js/script.js')!!}

     @yield('scripts')
</body>

</html>
