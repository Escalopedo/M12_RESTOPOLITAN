<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurantes</title>
</head>
<body>
    <h1>Listado de Restaurantes</h1>

    <ul>
        @foreach($restaurants as $restaurant)
            <li>{{ $restaurant->name }}</li>
        @endforeach
    </ul>
</body>
</html>