@extends('layouts.app')

@section('content')
    <h2 style="color:green;font-weight:bold;text-align:center;">{{ session('msg') }}</h2>
    <h1>Nos agences en France!</h1>



    <div class="container-xxl">



        <select class="w-50 container form-select" name="v_agency" id="v_agency" onchange="location = this.value">

            <option hidden value="">Choose your agency</option>
            <option value="/agencies">All Agencies</option>
            @foreach ($city as $cityy)
                <option value="/agencies/{{ $cityy->city }}">Agence de {{ $cityy->city }} -
                    {{ $cityy->title_agency }}
                </option>
            @endforeach
        </select>



        <div class="flexAnnonces">
            @foreach ($agencies as $agency)
                <div style="width:45%;" class="pt-5 mb-5 m-3">
                    <a href="/agencies/show/{{ $agency->id_agency }}"><img class="rounded d-block mx-auto mb-2"
                            style="width:90%;border:3px solid black;height:290px;"
                            src="{{ Storage::url($agency->photo) }}"></a>
                    <p class="text-center h4 mt-3 mb-3"><strong> {{ $agency->title_agency }}</strong></p>
                    <p class="text-center h4 mt-3 mb-3"><strong> {{ $agency->city }} - {{ $agency->pc }} -
                            {{ $agency->address }}</strong></p>
                    <p class="text-center h4 mt-3 mb-3"><strong> {{ $agency->description }} </strong></p>
                    <div class="text-center">
                        <a href="/agencies/show/{{ $agency->id_agency }}"
                            class="text-center mb-4 btn btn-dark btn-block p-1">Nous contacter</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- <table class="agency center">
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
    </table><br /> --}}
@endsection
