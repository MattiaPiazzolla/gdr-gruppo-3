<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DC comics / {{ Route::currentRouteName() }}</title>
    @vite('resources/js/app.js')
</head>

<body>
    <header>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>

    </footer>
</body>

</html>
