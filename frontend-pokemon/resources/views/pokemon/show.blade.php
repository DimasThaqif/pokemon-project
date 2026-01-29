@extends('layouts.app')

@section('content')
<div class="card mx-auto" style="max-width: 400px">
    <div class="card-body text-center">
        <h3 class="text-capitalize">{{ $pokemon['name'] }}</h3>
        <img src="{{ $pokemon['sprites']['front_default'] }}" alt="">
        <p>Height: {{ $pokemon['height'] }}</p>
        <p>Weight: {{ $pokemon['weight'] }}</p>

        <a href="/" class="btn btn-secondary btn-sm">⬅ Back</a>
    </div>
</div>
@endsection
