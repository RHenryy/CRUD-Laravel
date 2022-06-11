@extends('layouts.app')

@section('content')
    <h1>Vos annonces</h1>

    <h2 style="color:green;font-weight:bold;text-align:center">{{ session('msg') }}</h2>
    <div class="container">
        <div class="text-center mb-4">
            <button id="showModal" type="button" class="center w-25 btn btn-primary">Ici pour ajouter
                une
                annonce</button>
        </div>
        <div class="flexAnnonces">
            @foreach ($agents as $agent)
                <div style="width:45%;margin: 0 auto;" class="cardBackgroundColor pb-3 pt-5 mb-5">
                    <img class="rounded d-block mx-auto mb-2" style="width:90%;border:3px solid black;height:250px"
                        src="{{ Storage::url($agent->photo) }}">
                    <p class="text-center h4 mt-3 mb-3"><strong>{{ $agent->city }} - {{ $agent->title_location }} -
                            {{ $agent->rent_price }}€</strong></p>
                    <div class="text-center">
                        <div class="flexAround">
                            <a href="/locations/show/{{ $agent->id_location }}"
                                class="w-25 text-center mb-4 btn btn-primary btn-block p-2"><i
                                    class="fa-solid fa fa-plus"></i></a>
                            <a href="/agent/pictures/{{ $agent->id_location }}"
                                class="w-25 text-center mb-4 btn btn-warning btn-block p-2"><i
                                    class="fa-solid fa fa-plus"></i></a>
                            <a href="/agent/locations/edit/{{ $agent->id_location }}"
                                class="w-25 text-center mb-4 btn btn-success btn-block p-2"><i
                                    class="fa-solid fa fa-pen-fancy"></i>

                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
    <div id="backdrop" class="backdrop d-none" onclick="closeModal()">

    </div>
    <div id="modal" class="modal">
        <h2 class="text-center mb-4">Entrez les informations de l'annonce</h2>

        <form class="w-50 container" action="/locations" method="post" enctype="multipart/form-data">
            @csrf
            <label for="title">Appartment title:</label><br>
            <input class="form-control" type="text" name="title" placeholder="appartment name"><br>
            <label for="v_agency">Agency:</label>
            <select class="form-select" name="v_agency" id="v_agency">
                <option hidden value="">Choose your agency</option>
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
    </div>
@endsection
