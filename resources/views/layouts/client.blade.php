<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('assets/clients/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/clients/css/style.css')}}">
    @yield('css')
</head>
<body>
    <header>
        <h1>Header</h1>
    </header>
    <main>  
        <aside>
            @section('sidebar')
                @include('clients.blocks.sidebar')
            @show
        </aside>
        <div class="content">
            @yield('content')
        </div>
    </main>
    <footer>
        <h1>Footer</h1>
    </footer>

    <script src="{{assets('assets/clients/js/bootstrap.min.js')}}"></script>
    <script src="{{assets('assets/clients/js/custom.js')}}"></script>
    @yield('js')
</body>
</html>