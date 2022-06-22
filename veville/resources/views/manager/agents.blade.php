@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="text-center mb-4">
            <h1>Vos agents enregistrés</h1>
            <h2 class="mb-2" style="color:green;font-weight:bold;text-align:center">{{ session('msg') }}</h2>
            <button id="showModal" type="button" class="center w-25 btn btn-primary mt-0">Ici pour créer un compte pour
                un
                agent</button>
            <a class="btn btn-dark" href="/manager/agents/assign">Ou ici pour assigner un agent existant à une location</a>
        </div>

        <div class="flexAnnonces">
            @foreach ($agents as $agent)
                <div style="width:45%;margin: 0 auto;border:2px solid black;" class="pb-3 pt-5 mb-5">
                    <p class="text-center h4 mt-3 mb-3"><strong>Nom de l'agent : {{ $agent->name }}</strong></p>
                    <p class="text-center h4 mt-3 mb-3"><strong>Email de l'agent : {{ $agent->email }}</strong> <a
                            href="mailto:{{ $agent->email }}?subject={{ $agent->title_location }}"
                            class="btn btn-dark p-1">Contacter</a></p>
                    <p class="text-center h4 mt-3 mb-3"><strong>Location assignée : <a
                                href="/locations/show/{{ $agent->id_location }}">{{ $agent->title_location }}</a></strong>
                    </p>
                    <div class="text-center">
                        <a href="/locations/show/{{ $agent->id_location }}"><img class="mb-5" style="width: 50%;"
                                src="{{ Storage::url($agent->photo) }}"></a>
                    </div>
                    <div class="text-center">
                        <div class="flexAround">
                            <a href="/agents/show/{{ $agent->id_agent }}"
                                class="w-25 text-center mb-4 btn btn-primary btn-block p-2"><i
                                    class="fa-solid fa fa-plus"></i></a>
                            <a href="/agents/edit/{{ $agent->id_agent }}"
                                class="w-25 text-center mb-4 btn btn-success btn-block p-2"><i
                                    class="fa-solid fa fa-pen-fancy"></i>

                            </a>
                            <a href="/manager/agents/delete/{{ $agent->id_agent }}"
                                class="w-25 text-center mb-4 btn btn-danger btn-block p-2"><i
                                    class="fa-solid fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
    </div>
    <div id="backdrop" class="backdrop d-none" onclick="closeModal()">

    </div>
    <div id="modal" class="modal">
        <h2 class="text-center mb-4">Entrez les informations de l'agent</h2>

        <form class="w-75 container" action="" method="post" enctype="multipart/form-data">
            @csrf
            <label for="title">Nom de l'agent :</label>
            <input class="form-control mb-2" type="text" name="name" placeholder="agent name">

            <label for="price">Email :</label>
            <input class="form-control mb-2" type="text" name="email" placeholder="email">
            <label for="v_agency">Agence : </label>
            <select class="form-select mb-2" name="idAgency" id="v_agency">
                <option hidden value="">Choisissez l'agence</option>
                @foreach ($agencies as $agency)
                    <option value="{{ $agency->id_agency }}">{{ $agency->title_agency }} - {{ $agency->city }}
                    </option>
                @endforeach
            </select>

            <label for="location">Location à attribuer : </label>
            <select class="form-select mb-2" name="idLocation" id="location">
                <option hidden value="">Location à attribuer</option>
                @foreach ($locations as $locationSelect)
                    <option value="{{ $locationSelect->id_location }}">{{ $locationSelect->title_location }} -
                        {{ $locationSelect->city }}
                    </option>
                @endforeach
            </select>
            <div class="text-center mt-4">
                <input class="btn btn-primary" type="submit" value="Ajouter l'agent">
            </div>
        </form>
    </div>
@endsection
