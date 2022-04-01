@extends('layouts.app')

@section('content')
    <header class="indexHeader">
        <div class="wrapper">
            <h1>Toutes nos locations!</h1>
        </div>

        @foreach ($vehicles as $vehicle)
            <img class="rounded d-block mx-auto mb-2" style="width:60%;" src="{{ Storage::url($vehicle->photo) }}">
            <p class="text-center"><strong>{{ $vehicle->title }} - {{ $vehicle->daily_price }}€</strong></p>
            <div style="width:20%;" class="d-block mx-auto">
                <button type=" submit" class="mb-5 btn btn-primary btn-block p-3">Louez dès maintenant!</button>
            </div>
        @endforeach

    </header>
@endsection
