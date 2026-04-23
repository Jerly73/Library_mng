<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Cena Library' }}</title>
        @vite('resources/css/app.css')

<body>

{{ $slot }}
</body>
</html>
