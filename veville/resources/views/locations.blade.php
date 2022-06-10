@extends('layouts.app')

@section('content')
    <h1>Nos Appartements à la location</h1> <br />

    <h2 style="color:green;font-weight:bold;text-align:center">{{ session('msg') }}</h2><br />

    <select id="agence" class=" w-50 form-select container" name="v_agency" id="v_agency" onchange="location = this.value">
        <option hidden value="">Filter by city</option>
        <option value="/locations">All cities</option>
        @foreach ($agencies as $agence)
            <option value="/locations/{{ $agence->id_agency }}">
           {{ $agence->city }}
            </option>
        @endforeach
    </select>
    <br />
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
    </table><br />

@endsection
