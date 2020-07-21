<html>
    <head>
        <title>VetClin - @yield('a')</title>
        <meta charset="UTF-8">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            body { padding: 20px; }
            .navbar { margin-bottom: 30px; }
            .card{ margin: 20px; }
            .card-header { color: white; }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark d-flex justify-content-between">
            <a class="navbar-brand" href="/">
                <b>{{$titulo}}</b>
            </a>
            <a class="navbar-brand mx-auto">
                <b>SETA - Sistema de Entrega de Trabalhos e Atividades</b>
            </a>
            <ul class="navbar-nav">
                <li class="nav-item" >
                    <a class="nav-link" href="#">
                        <b>|Home|</b>
                    </a>
                </li>
            </ul>
        </nav>
        @yield('conteudo')
        <hr>
    </body>
    <footer>
        <b>&copy; 2020 - Gustavo Galdino de Camargo.</b>
    </footer>
    <script src="{{asset('js/app.js')}}" type='text/javascript'></script>
    @yield('script')

</html>