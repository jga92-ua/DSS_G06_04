@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Cartas de la expansión</h2>

    <div class="row">
        @forelse ($cartas as $carta)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <a href="{{ route('cartas.show', ['id_carta_api' => $carta['id']]) }}">
                        <img src="{{ $carta['images']['large'] }}" class="card-img-top" alt="{{ $carta['name'] }}">
                    </a>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $carta['name'] }}</h5>
                        <p class="text-muted">{{ $carta['set']['name'] }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay cartas en esta expansión.</p>
        @endforelse
    </div>
</div>
@endsection
