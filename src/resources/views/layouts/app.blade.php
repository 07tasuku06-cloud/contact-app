<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>

    <header class="header">
        <div class="header__inner">
            <h1 class="header__logo">FashionablyLate</h1>

            @auth
            <div class="header__logout">
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="logout-button">
                        Logout
                    </button>
                </form>
            </div>
            @endauth

        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

</body>

</html>