<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dragon Ball</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">--}}
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"> 
</head>
<body>
    <div class="md:container md:mx-auto mt-5">
        <button onclick="window.history.back()" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 mt-3">
            Volver atrás
        </button>
        <h2 class="text-4xl font-extrabold dark:text-white">Listado de Dragon Ball</h2>

        @if(isset($characterData))
            <!-- Contenedor de la cuadrícula con 4 columnas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($characterData as $index => $dragon)
                    <div class="bg-gray-300 p-4">
                        <div class="card" style="width: 18rem;">
                            <!-- Imagen con tamaño fijo y sin recorte -->
                            <img src="{{ $dragon['image'] }}" class="card-img-top w-full h-64 object-contain" alt="Imagen de {{ $dragon['name'] }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ ucfirst($dragon['name']) }}</h5>
                                <p class="card-text">
                                    <strong>ID:</strong> {{ $dragon['id'] }}<br>
                                    <strong>Género:</strong> {{ $dragon['gender'] }}<br>
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('dragonID', $dragon['id']) }}" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 mt-3">
                                    Ver más de {{ $dragon['name'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif(isset($error))
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endif
    
    </div>
</body>
</html>
