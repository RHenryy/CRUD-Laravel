@extends('layouts.app')

@section('content')
    <div class="product">

        <p> {{ $locations[0]->title_location }} - Loyer de {{ $locations[0]->rent_price }}€ tcc </p>



        <div id="myCarousel" class="carousel slide container mb-3 mt-5" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img style="max-height:650px;" class="d-block w-100"
                        src="{{ asset('storage/' . $locations[0]->photo) }}" alt="{{ $locations[0]->title_location }}">
                </div>

                @foreach ($images as $image)
                    <div class="carousel-item">
                        <img style="max-height:650px;" class="d-block w-100" src="{{ asset('storage/' . $image->src) }}"
                            alt="{{ $image->title_location }}">
                    </div>
                @endforeach
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            {{-- <p><img style="width:50%;" src="{{ asset('storage/' . $locations[0]->photo) }}"></p> --}}
        </div>
        <div style="text-align:center">
            <a id="showModal" style="width:20%;padding:0.5rem;" class="btn btn-primary">Prenez rendez-vous maintenant !</a>
        </div>
        <div id="backdrop" class="backdrop d-none" onclick="closeModal()">

        </div>
        <div id="modal" class="modal">

            <h1 class="mb-3"> Prenez rendez-vous avec un des agents en charge de l'annonce !</h1>

            <form method="post" action="/contact/" class="w-50 container ">
                @csrf
                <label for="agentLocation">Agent à contacter: </label>
                <select class=" w-100 form-select mb-3" name="agent_id" id="agentLocation">
                    <option hidden>Choisissez un des agents listés ici</option>
                    @foreach ($contacts as $contact)
                        <option value="{{ $contact->id_user }}">{{ $contact->name }}</option>
                    @endforeach
                </select>
                <label for="username">Nom d'utilisateur: </label>
                <input id="username" name="name" type="text" class="form-control"
                    value="@if (Auth::check()) {{ Auth::user()->name }} @endif"><br>
                <label for="emailUser">Votre e-mail: </label>
                <input id="emailUser" name="email" type="text" class="form-control"
                    value="@if (Auth::check()) {{ Auth::user()->email }} @endif"><br>
                <label for="messageUser">Votre message message: </label>
                <textarea id="messageUser" class="w-100 form-control" name="message" type="text" class="w-100 form-control">Bonjour, je serais intéressé par cet appartement. Cordialement.</textarea>
                <div class="text-center">
                    <input type="submit" class="w-50 mt-4 btn btn-primary" value="Envoyer">
                </div>
                <input type="text" hidden value="{{ $contact->id_location }}" name="idLocation">
                <input type="text" hidden value="{{ $contact->id_agency }}" name="idAgency">
            </form>
        </div>
    @endsection
