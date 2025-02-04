<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Grid</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Pokémon</h1>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach ($pokemons as $pokemon)
                <div class="bg-white rounded-lg shadow-md p-4 text-center">
                    <img src="{{ $pokemon['image'] }}" alt="{{ $pokemon['name'] }}" class="w-20 h-20 mx-auto">
                    <h2 class="mt-2 text-lg font-semibold capitalize">{{ $pokemon['name'] }}</h2>
                </div>
            @endforeach
        </div>
    </div>
    <div class="flex justify-between mt-8">
        <a href="?offset={{ max(0, $offset - $limit) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Previous</a>
        <a href="?offset={{ $offset + $limit }}" class="bg-green-500 text-white px-4 py-2 rounded">Next</a>
    </div>
</body>
</html>
