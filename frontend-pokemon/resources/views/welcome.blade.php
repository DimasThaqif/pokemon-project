<!DOCTYPE html>
<html>
<head>
    <title>Pokédex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-danger mb-4">
    <div class="container">
        <span class="navbar-brand">🔥 Pokédex Laravel</span>
    </div>
</nav>

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Pokédex Laravel Jalan 🚀</h1>
</div>
@endsection


<div class="container">
    @yield('content')
</div>
</body>
</html>
