<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} </title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/814c1646f8.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            background: url({{ asset('main-background.jpg') }});
        }

        #conteudo {
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 5px;
            width: 96%;
            margin: 2%;
            padding: 3%;
        }

    </style>
</head>

<body class="antialiased">
    <ul class="nav d-flex justify-content-center bg-primary">
        @if (Route::has('login'))
            @auth
                <li class="nav-item p-2">
                    <a href="{{ url('/home') }}" class="text-decoration-none">Home</a>
                </li>
            @else
                <li class="nav-item p-2">
                    <a href="{{ route('login') }}" class="btn btn-primary text-decoration-none">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        Log in
                    </a>
                </li>

                @if (Route::has('register'))
                    <li class="nav-item p-2">
                        <a href="{{ route('register') }}" class="btn btn-primary text-decoration-none">
                            <i class="fa-solid fa-plus"></i>
                            Registre-se
                        </a>
                    </li>
                @endif
            @endauth
        @endif
    </ul>
    <div id="conteudo">
        <h1 class='display-6'>
            <i class="fa-solid fa-list-check"></i>
            {{ env('APP_NAME') }}
        </h1>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque imperdiet dui turpis, et varius lectus
            sodales id. Suspendisse suscipit vitae purus sed egestas. Fusce hendrerit nisl vitae tempor venenatis. Etiam
            leo tellus, egestas eget tellus ac, eleifend consequat est. Nunc ultricies lorem metus, eget scelerisque
            ligula pretium nec. Aenean commodo et mi a varius. Duis molestie, magna ut volutpat dapibus, enim turpis
            faucibus lectus, a lacinia nibh massa at mauris. Pellentesque ut ante risus. Phasellus id libero placerat
            mauris bibendum convallis sed ut nisi. Praesent id leo at purus scelerisque lacinia vitae in arcu. Sed
            pretium sem orci, ac lacinia felis hendrerit iaculis.
        </p>
        <p>
            Duis bibendum purus nisi, nec varius leo pharetra a. Ut elementum quis elit fermentum feugiat. Suspendisse
            rhoncus vitae mi sit amet vestibulum. Sed venenatis convallis sapien sit amet fermentum. Suspendisse ac
            sapien nunc. Donec vitae aliquam diam. Vestibulum et diam vel lorem tristique maximus. In urna lectus,
            semper at sapien vel, rhoncus rhoncus neque. Sed quis massa neque. Curabitur dictum tincidunt ullamcorper.
            Quisque eu sem malesuada, facilisis metus in, congue orci.

        </p>
    </div>
</body>

</html>
