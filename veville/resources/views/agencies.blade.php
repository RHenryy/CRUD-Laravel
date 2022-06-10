@extends('layouts.app')

@section('content')
    <h1>Nos agences en France!</h1> <br />


    <h2 style="color:green;font-weight:bold;text-align:center;">{{ session('msg') }}</h2><br />


    <form action="/agencies" method="POST">
        @csrf

        <select class=" w-50 container form-select" name="v_agency" id="v_agency" onchange="location = this.value">

            <option hidden value="">Choose your agency</option>
            <option value="/agencies">All Agencies</option>
            @foreach ($city as $cityy)
                <option value="/agencies/{{ $cityy->city }}">Agence de {{ $cityy->city }} - {{ $cityy->title_agency }}
                </option>
            @endforeach
        </select>

    </form>
    <br />



    <table class="agency center">
        <tr>
            <th> titre </th>
            <th>ville</th>
            <th>cp</th>
            <th>adresse</th>
            <th>description</th>
            <th>photo</th>
        </tr>
        @foreach ($agencies as $agency)
            <tr onclick="window.location='/agencies/show/{{ $agency->id_agency }}';">
                <td> {{ $agency->title_agency }} </td>
                <td> {{ $agency->city }} </td>
                <td> {{ $agency->pc }} </td>
                <td> {{ $agency->address }} </td>
                <td> {{ $agency->description }} </td>
                <td style="width:20%;"> <img style="width:80%;" src="{{ Storage::url($agency->photo) }}">
                </td>

            </tr>
        @endforeach
    </table><br />
@endsection
