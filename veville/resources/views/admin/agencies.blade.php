@extends('layouts.app')

@section('content')
    <h1>Nos agences en France!</h1> <br />


    <h2 style="color:green;font-weight:bold;text-align:center;">{{ session('msg') }}</h2><br />


    <form action="/agencies" method="POST">
        @csrf

        <select class="w-100 container form-select" name="v_agency" id="v_agency" onchange="location = this.value">

            <option hidden value="">Choose your agency</option>
            <option value="/agencies">All Agencies</option>
            @foreach ($city as $cityy)
                <option value="/agencies/{{ $cityy->city }}">Agence de {{ $cityy->city }}</option>
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

            <th>actions</th>

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

                <td> <a href="/admin/agencies/delete/{{ $agency->id_agency }}">
                        <i class="fa-solid fa-2x fa-trash"></i></a> <span style="font-size:35px">---</span>
                    <a href="/admin/agencies/edit/{{ $agency->id_agency }}">
                        <i class="fa-solid fa-2x fa-pen-fancy"></i>
                    </a>
                </td>

            </tr>
        @endforeach
    </table><br />

    <form class="w-50 container" action="/agencies" method="post" enctype="multipart/form-data">
        @csrf
        <label for="name">Agency name:</label><br>
        <input class="form-control" type="text" id="name" name="name" placeholder="agency name"><br>
        <label for="address">address</label><br>
        <input class="form-control" type="text" id="address" name="address" placeholder="address"><br>
        <label for="city">city</label><br>
        <input class="form-control" type="text" value="{{ $autofill }}" name="city" placeholder="city"><br>
        <label for="pc">Postal code</label><br>
        <input class="form-control" type="text" name="pc" placeholder="pc"><br>
        <label for="pc">Map</label><br>
        <input class="form-control" type="text" name="map" placeholder="map"><br>
        <label for="photo">Photo</label><br>
        <input class="form-control" type="file" name="photo" placeholder="photo"><br>
        <label for="description">Description</label><br>
        <textarea class="form-control" name="description" placeholder="Agency Description"></textarea><br>
        <button type="submit" name="action" value="add" class="w-100 btn btn-primary">Submit</button>

    </form>
@endsection
