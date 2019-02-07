<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>


    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">

</head>
<body>
<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/')}}">Brand</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{url('/weather')}}">Погода</a></li>
                    <li><a href="{{url('/orders')}}">Заказы</a></li>
                </ul>
            </div>
        </div>
    </nav>

</header>
<main>
    @if(session()->has('alert'))
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-{{session()->get('alertClass')}} in fade" role="alert">
                        {{session()->get('alert')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @yield('content')
</main>

<footer>

</footer>

<!-- Scripts -->
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
@stack('scripts')
</body>
</html>
