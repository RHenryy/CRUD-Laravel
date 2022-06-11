@extends('layouts.app')

@section('content')
    <h1>Nos Appartements à la location</h1>

    <h2 style="color:green;font-weight:bold;text-align:center">{{ session('msg') }}</h2>
    <div class="container">
        <select id="agence" class="w-50 form-select container" name="v_agency" id="v_agency"
            onchange="location = this.value">
            <option hidden value="">Filter by city</option>
            <option value="/locations">All cities</option>
            @foreach ($agencies as $agence)
                <option value="/locations/{{ $agence->id_agency }}">
                    {{ $agence->city }}
                </option>
            @endforeach
        </select>

        <div class="flexAnnonces">
            @foreach ($locations as $location)
                <div style="width:45%;margin: 0 auto;" class="cardBackgroundColor pb-3 pt-5 mb-5">
                    <img class="rounded d-block mx-auto mb-2" style="width:90%;border:3px solid black;height:250px"
                        src="{{ Storage::url($location->photo) }}">
                    <p class="text-center h4 mt-3 mb-3"><strong>{{ $location->city }} - {{ $location->title_location }} -
                            {{ $location->rent_price }}€</strong></p>
                    <div class="text-center">
                        <a href="/locations/show/{{ $location->id_location }}"
                            class="text-center mb-4 btn btn-primary btn-block p-3">Louez dès maintenant!</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- <br />
    <table class="agency center">
        <tr>
            <th>Appartement</th>
            <th>Agence</th>
            <th>Ville</th>
            <th>description</th>
            <th>Loyer</th>
            <th>photo</th>


        </tr>

        @foreach ($locations as $location)
            <tr onclick="window.location='/locations/show/{{ $location->id_location }}';">

                <td> {{ $location->title_location }} </td>
                <td> {{ $location->agency }}</td>
                <td> {{ $location->city }}</td>
                <td> {{ $location->description }} </td>
                <td> {{ $location->rent_price }}€ </td>
                <td> <img style="width: 50%" src="{{ Storage::url($location->photo) }}"> </td>
            </tr>
        @endforeach
    </table><br /> --}}
@endsection
