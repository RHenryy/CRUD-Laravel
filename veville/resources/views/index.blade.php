@extends('layouts.app')

@section('content')
    <header class="indexHeader">
        <div class="wrapper">
            <h1>Toutes nos locations!</h1>
        </div>


        <select style="cursor:pointer;" class="w-50 container form-select" name="v_agency" id="v_agency"
            onchange="location = this.value">

            <option hidden value="">Choose your agency</option>
            <option value="/">All Locations</option>
            @foreach ($agencies as $agency)
                <option value="/filter/{{ $agency->city }}">Agence de {{ $agency->city }}
                </option>
            @endforeach
        </select>


        <div class="flexAnnonces">
            @foreach ($locations as $location)
                <div style="width:45%;margin: 0 auto;" class="cardBackgroundColor pb-3 pt-5 mb-5">
                    <a href="/locations/show/{{ $location->id_location }}"><img class="rounded d-block mx-auto mb-2"
                            style="width:90%;border:3px solid black;height:250px"
                            src="{{ Storage::url($location->photo) }}"></a>
                    <p class="text-center h4 mt-3 mb-3"><strong>{{ $location->city }} - {{ $location->title_location }} -
                            {{ $location->rent_price }}€</strong></p>
                    <div class="text-center">
                        <a href="/locations/show/{{ $location->id_location }}"
                            class="text-center mb-4 mt-3 btn btn-primary btn-block p-2">Louez dès maintenant!</a>
                    </div>
                </div>
            @endforeach
        </div>
    </header>
@endsection
