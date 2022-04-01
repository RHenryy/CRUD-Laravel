@extends('layouts.app')

@section('content')
    <h1>Nos Appartements à la location</h1> <br />

    <h2 style="color:green;font-weight:bold;text-align:center">{{ session('msg') }}</h2><br />

    <select id="agence" class=" w-50 form-select container" name="v_agency" id="v_agency" onchange="location = this.value">
        <option hidden value="">Choose your location</option>
        <option value="/vehicles">All Locations</option>
        @foreach ($agencies as $agence)
            <option value="/vehicles/{{ $agence->id_agency }}">
                {{ $agence->title_agency }} - {{ $agence->city }}
            </option>
        @endforeach
    </select>
    <br />
    <table class="agency center">
        <tr>
            <th>Véhicule</th>
            <th>Agence</th>
            <th>titre</th>
            <th>marque</th>
            <th>modèle</th>
            <th>description</th>
            <th>photo</th>
            <th>prix</th>
            <th>actions</th>
        </tr>

        @foreach ($vehicles as $vehicle)
            <tr onclick="window.location='/vehicles/show/{{ $vehicle->id_vehicle }}';">

                <td> {{ $vehicle->id_vehicle }} </td>
                <td> {{ $vehicle->agence }}</td>
                <td> {{ $vehicle->title }} </td>
                <td> {{ $vehicle->brand }} </td>
                <td> {{ $vehicle->model }} </td>
                <td> {{ $vehicle->description }} </td>
                <td> <img style="width: 50%" src="{{ Storage::url($vehicle->photo) }}"> </td>
                <td> {{ $vehicle->daily_price }}€ </td>


                <td style="width:20%"> <a href="vehicles/delete/{{ $vehicle->id_vehicle }}">
                        <i class="fa-solid fa-2x fa-trash"></i></a> <span style="font-size:35px">---</span>
                    <a href="vehicles/edit/{{ $vehicle->id_vehicle }}">
                        <i class="fa-solid fa-2x fa-pen-fancy"></i>
                    </a>
                </td>

            </tr>
        @endforeach
    </table><br />

    <form class="w-50 container" action="/vehicles" method="post" enctype="multipart/form-data">
        @csrf
        <label for="title">Appartment name:</label><br>
        <input class="form-control" type="text" name="title" placeholder="vehicle name"><br>
        <label for="brand">Brand</label><br>
        <input class="form-control" type="text" name="brand" placeholder="brand"><br>
        <label for="model">model</label><br>
        <input class="form-control" type="text" name="model" placeholder="model"><br>
        <label for="v_agency">Agency</label>
        <select class="form-select" name="v_agency" id="v_agency">
            <option hidden value="">Choose your agency</option>
            @foreach ($agencies as $agency)
                <option value="{{ $agency->id_agency }}">{{ $agency->title_agency }} - {{ $agency->city }}
                </option>
            @endforeach
        </select>
        <label for="price">Price</label><br>
        <input class="form-control" type="text" name="price" placeholder="price"><br>
        <label for="description">Description</label><br>
        <textarea class="form-control" name="description" placeholder="Vehicle Description"></textarea><br>

        <label for="photo">Photo</label><br>
        <input class="form-control" type="file" name="photo" placeholder="photo"><br>



        <button type="submit" class=" mb-3 w-100 btn btn-primary">Submit</button>

    </form>
@endsection
