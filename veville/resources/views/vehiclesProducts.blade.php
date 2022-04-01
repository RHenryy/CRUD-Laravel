@extends('layouts.app')

@section('content')
    <div class="product">
        <p>{{ $vehicles[0]->brand }} - {{ $vehicles[0]->title }} - {{ $vehicles[0]->model }}

        <p><img style="width:50%;" src="{{ asset('storage/' . $vehicles[0]->photo) }}"></p>
        <p>{{ $vehicles[0]->daily_price }}€</p>
        <p>{{ $vehicles[0]->description }}</p>
    </div>
    <div style="text-align:center">
        <button style="width:20%;padding:1rem;" type="submit" name="action" value="add" class="btn btn-primary">Louez
            maintenant!</button>
    </div>
@endsection
