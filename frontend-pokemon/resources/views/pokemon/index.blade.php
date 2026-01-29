<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pokédex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="mb-4 text-center">🔥 Pokédex</h1>

    <div class="row">
        @foreach ($pokemons as $pokemon)
    <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-capitalize">
                    {{ $pokemon }}
                </h5>
            </div>
        </div>
    </div>
@endforeach

    </div>
</div>

</body>
</html>

