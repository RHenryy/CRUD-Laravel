@extends('layouts.app')

@section('content')


    <h1>Nos Appartements à la location</h1> <br />

    <h2 style="color:green;font-weight:bold;text-align:center">{{ session('msg') }}</h2><br />

    <br />
    <table class="agency center">
        <tr>
            <th>Appartement</th>
            <th>Agence</th>
            <th>Ville</th>
            <th>description</th>
            <th>Loyer</th>
            <th>photo</th>
     
                <th>actions</th>
      

        </tr>

        @foreach ($agents as $agent)
            <tr onclick="window.location='/locations/show/{{ $agent->id_location }}';">

                <td> {{ $agent->title_location }} </td>
                <td> {{ $agent->title_agency }}</td>
                <td> {{ $agent->city }}</td>
                <td> {{ $agent->description }} </td>
                <td> {{ $agent->rent_price }}€ </td>
               

                <td> <img style="width: 50%" src="{{ Storage::url($agent->photo) }}"> </td>
          
                    {{-- <td style="width:20%"> <a href="./locations/delete/{{ $agent->id_location }}">
                            <i class="fa-solid fa-2x fa-trash"></i></a> <span style="font-size:35px">---</span> --}}
                        <td><a href="/agent/locations/edit/{{ $agent->id_location }}">
                            <i class="fa-solid fa-2x fa-pen-fancy"></i>
                        </a><span style="font-size:35px"></span>
                        <a href="/agent/pictures/{{ $agent->id_location }}">
                        <i class="fa-solid fa-2x fa-plus"></i>
                        </a>
                    </td>
    


            </tr>
        @endforeach
    </table><br />

    <form class="w-25 container" action="/locations" method="post" enctype="multipart/form-data">
        @csrf
        <label for="title">Appartment title:</label><br>
        <input class="form-control" type="text" name="title" placeholder="appartment name"><br>
        <label for="v_agency">Agency:</label>
        <select class="form-select" name="v_agency" id="v_agency">
            <option hidden value="">Choose your agency</option>
            {{-- <option value="">All</option> --}}
            @foreach ($agents as $agent)
            
                <option value="{{ $agent->id_agency }}">{{ $agent->title_agency }} - {{ $agent->city }}
                </option>
            @endforeach
        </select>
        <label for="price">Rent Price:</label><br>
        <input class="form-control" type="text" name="rent_price" placeholder="rent"><br>
        <label for="description">Description</label><br>
        <textarea class="form-control" name="description" placeholder="Appartment Description"></textarea><br>
        <label for="photo">Photo:</label><br>
        <input class="form-control" type="file" name="photo" placeholder="photo"><br>
        <button type="submit" class=" mb-3 w-100 btn btn-primary">Submit</button>

    </form>

@endsection
