<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dragon ball Z</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"> 
</head>

<body>
    <div class="md:container md:mx-auto mt-5">
        <button onclick="window.history.back()" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 mt-3">
            Volver atrás
        </button>
        <h2 class="text-4xl font-extrabold dark:text-white">Información del Personaje</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-300 p-4 mt-5">
            <!-- Columna de la imagen -->
            <div class="flex justify-center items-center">
                <img src="{{ $character->img }}" class="card-img-top w-full h-64 object-contain" alt="Imagen de {{ $character->nombre }}">
            </div>
    
            <!-- Columna de la información -->
            <div class="flex flex-col justify-center">
                <h5 class="text-2xl font-semibold">{{ $character->nombre }}</h5>
                <p class="text-lg mt-3">
                    <strong>ID: </strong> {{ $character->id }}<br>
                    <strong>Nombre: </strong> {{ $character->nombre }}<br>
                    <strong>Ki: </strong> {{ $character->ki }}<br>
                    <strong>Ki máximo: </strong> {{ $character->maxKi }}<br>
                    <strong>Raza: </strong> {{ $character->raza }}<br>
                    <strong>Género: </strong> {{ $character->genero }}<br>
                </p>
            </div>
        </div>

    </div>
</body>

</html>
