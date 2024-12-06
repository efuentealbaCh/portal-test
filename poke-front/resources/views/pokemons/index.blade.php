<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémons</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"> 

</head>
<body>
    <div class="md:container md:mx-auto mt-5">

        <button onclick="window.history.back()" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 mt-3">
            Volver atrás
        </button>
        <h2 class="text-4xl font-extrabold dark:text-white">Información del Pokemon</h2>
        
        @if(isset($pokemon))      
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-300 p-4 mt-5"> 
            <div class="flex justify-center items-center">
                <img src="{{ $pokemon['imagen'] }}" class="card-img-top w-full h-64 object-contain" alt="Imagen de {{ $pokemon['nombre'] }}">
            </div>     
            <div class="flex flex-col justify-center">
                <h5 class="text-2xl font-semibold">{{ ucfirst($pokemon['nombre']) }}</h5>
                <p class="text-lg mt-3">
                    <strong>ID:</strong> {{ $pokemon['id'] }}<br>
                    <strong>Tipo:</strong> {{ implode(', ', $pokemon['tipo']) }}<br>
                    <strong>Altura:</strong> {{ $pokemon['altura'] }}<br>
                    <strong>Peso:</strong> {{ $pokemon['peso'] }}<br>
                </p>
            </div>
        </div>
        @elseif(isset($error))
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endif
    </div>
</body>
</html>
