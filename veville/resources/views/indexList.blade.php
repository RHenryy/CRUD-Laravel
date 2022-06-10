@extends('layouts.app')

@section('content')
    <header class="indexHeader">
        <div class="wrapper">
            <h1>Toutes nos locations!</h1>
        </div>
        <form action="/" method="POST">
            @csrf
    
            <select class=" w-50 container form-select" name="v_agency" id="v_agency" onchange="location = this.value">
    
                <option hidden value="">Choose your agency</option>
                <option value="/">All Locations</option> 
                @foreach ($agencies as $agency)
       
                    <option value="/filter/{{ $agency->city }}">Agence de {{ $agency->city }}</option>
                @endforeach
            </select>
    
        </form>
        @foreach ($locations as $location)
            <img class="rounded d-block mx-auto mb-2" style="width:60%;" src="{{ Storage::url($location->photo) }}">
            <p class="text-center h4 mt-3 mb-3"><strong>{{ $location->city }} - {{ $location->title_location }} - {{ $location->rent_price }}€</strong></p>
           <div class="text-center">
                <a href="/locations/show/{{ $location->id_location }}" class="text-center mb-5 btn btn-primary btn-block p-3">Louez dès maintenant!</a>
          </div>
        @endforeach

    </header>
@endsection
