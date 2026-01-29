@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        @foreach ($pokemons as $pokemon)
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="text-capitalize">{{ $pokemon['name'] }}</h5>
                        <a href="/pokemon/{{ $pokemon['name'] }}" class="btn btn-danger btn-sm">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
