<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body>
<header>
    <nav class="flex justify-center">
        <a href="{{ route('cage.index') }}" class="m-4">На главную</a>
        <a href="{{ route('animal.index') }}" class="m-4">Животные</a>
    </nav>
</header>

{{ $slot }}
</body>
</html>
