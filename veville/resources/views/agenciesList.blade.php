@extends('layouts.app')

@section('content')
    <div class="product">

        <p>{{ $agencies[0]->title_agency }} - {{ $agencies[0]->address }} - {{ $agencies[0]->city }}
            <strong>
                <p>{{ $agencies[0]->description }}</p>
            </strong>
        <p><img style="width:60%;" src="{{ asset('storage/' . $agencies[0]->photo) }}"></p>
        <br />
        <p><iframe style="width:60%;" {!! $agencies[0]->map !!}> </iframe> </p>
    </div>
    <div style="text-align:center">
        <button style="width:30%;padding:1rem;" type="submit" name="action" value="add" class="btn btn-primary">Prenez
            rendez-vous maintenant!</button>
    </div>
@endsection
