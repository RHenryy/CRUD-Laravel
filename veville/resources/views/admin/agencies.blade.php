@extends('layouts.app')

@section('content')
    <h1>Nos agences en France!</h1> <br />


    <h2 style="color:green;font-weight:bold;text-align:center;">{{ session('msg') }}</h2><br />



    <div class="container">

        <select class="w-50 container form-select" name="v_agency" id="v_agency" onchange="location = this.value">

            <option hidden value="">Choose your agency</option>
            <option value="/agencies">All Agencies</option>
            @foreach ($city as $cityy)
                <option value="/agencies/{{ $cityy->city }}">Agence de {{ $cityy->city }}</option>
            @endforeach
        </select>
        <div class="text-center mb-4">
            <button id="showModal" type="button" class="center w-25 btn btn-primary">Ici pour ajouter
                une
                agence</button>
        </div>
        <div class="flexAnnonces">
            @foreach ($agencies as $agency)
                <div style="width:45%;" class="cardBackgroundColor pt-5 mb-5 m-3">
                    <img class="rounded d-block mx-auto mb-2" style="width:80%;border:3px solid black"
                        src="{{ Storage::url($agency->photo) }}">
                    <p class="text-center h4 mt-3 mb-3"><strong> {{ $agency->title_agency }}</strong></p>
                    <p class="text-center h4 mt-3 mb-3"><strong> {{ $agency->city }} - {{ $agency->pc }} -
                            {{ $agency->address }}</strong></p>
                    <p class="text-center h4 mt-3 mb-3"><strong> {{ $agency->description }} </strong></p>
                    <div class="text-center">
                        <div class="flexAround">
                            <a href="/agencies/show/{{ $agency->id_agency }}"
                                class="w-25 text-center mb-4 btn btn-primary btn-block p-2"><i
                                    class="fa-solid fa fa-plus"></i></a>
                            <a href="/admin/agencies/edit/{{ $agency->id_agency }}"
                                class="w-25 text-center mb-4 btn btn-success btn-block p-2"><i
                                    class="fa-solid fa fa-pen-fancy"></i>

                            </a>
                            <a href="/admin/agencies/delete/{{ $agency->id_agency }}"
                                class="w-25 text-center mb-4 btn btn-danger btn-block p-2"><i
                                    class="fa-solid fa fa-trash"></i></a>


                        </div>
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
    </table><br /> --}}
    <div id="backdrop" class="backdrop d-none" onclick="closeModal()">

    </div>
    <div id="modal" class="modal">
        <h2 class="text-center mb-4">Entrez les informations de l'agence</h2>
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
    </div>
@endsection
