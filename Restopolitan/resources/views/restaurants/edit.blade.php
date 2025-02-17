<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Restaurante</title>
</head>
<body>
    <h1>Editar Restaurante: {{ $restaurant->name }}</h1>

    <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nombre</label>
            <input type="text" name="name" value="{{ $restaurant->name }}" required>
        </div>

        <div>
            <label for="description">Descripción</label>
            <textarea name="description">{{ $restaurant->description }}</textarea>
        </div>

        <div>
            <label for="average_price">Precio Promedio (€)</label>
            <input type="text" name="average_price" value="{{ $restaurant->average_price }}" required>
        </div>

        <div>
            <label for="photo">Foto</label>
            <input type="file" name="photo">
        </div>

        <button type="submit">Actualizar Restaurante</button>
    </form>

</body>
</html>
