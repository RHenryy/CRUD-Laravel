@extends('layouts.app')

@section('content')
    <h1>Nos agences en France!</h1> <br />


    <h2 style="color:green;font-weight:bold;text-align:center;">{{ session('msg') }}</h2><br />

    <table class="agency center">
        <tr>
            <th> titre </th>
           
            <th>ville</th>
            <th>cp</th> 
            <th>adresse</th>
            <th>description</th>
            <th>photo</th>
            {{-- <th>actions</th> --}}

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
                {{-- <td> <a href="/agent/agencies/delete/{{ $agency->id_agency }}">
                        <i class="fa-solid fa-2x fa-trash"></i></a> <span style="font-size:35px">---</span>
                    <a href="/agent/agencies/edit/{{ $agency->id_agency }}">
                        <i class="fa-solid fa-2x fa-pen-fancy"></i>
                    </a>
                </td> --}}

            </tr>
        @endforeach
    </table><br />
@endsection
