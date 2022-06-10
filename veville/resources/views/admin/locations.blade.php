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

            <th>actions</th>


        </tr>

        @foreach ($locations as $location)
            <tr onclick="window.location='/locations/show/{{ $location->id_location }}';">

                <td> {{ $location->title_location }} </td>
                <td> {{ $location->agency }}</td>
                <td> {{ $location->city }}</td>

                <td> {{ $location->rent_price }}€ </td>
                <td> {{ $location->description }} </td>

                <td> <img style="width: 50%" src="{{ Storage::url($location->photo) }}"> </td>

                <td style="width:20%"> <a href="/admin/locations/delete/{{ $location->id_location }}">
                        <i class="fa-solid fa-2x fa-trash"></i></a> <span style="font-size:35px">---</span>
                    <a href="/admin/locations/edit/{{ $location->id_location }}">
                        <i class="fa-solid fa-2x fa-pen-fancy"></i>
                    </a><span style="font-size:35px">---</span>
                    <a href="/admin/pictures/{{ $location->id_location }}">
                        <i class="fa-solid fa-2x fa-plus"></i>
                    </a>
                </td>



            </tr>
        @endforeach
    </table><br />

    <form class="w-50 container" action="/locations" method="post" enctype="multipart/form-data">
        @csrf
        <label for="title">Appartment title:</label><br>
        <input class="form-control" type="text" name="title" placeholder="appartment name"><br>
        <label for="v_agency">Agency:</label>
        <select class="form-select" name="v_agency" id="v_agency">
            <option hidden value="">Choose your agency</option>
            @foreach ($agencies as $agency)
                <option value="{{ $agency->id_agency }}">{{ $agency->title_agency }} - {{ $agency->city }}
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
