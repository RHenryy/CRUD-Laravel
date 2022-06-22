@extends('layouts.app')

@section('content')
    <h2 class="mt-4" style="color:green;font-weight:bold;text-align:center;">{{ session('msg') }}</h2>
    <div class="product">
        <div class="mb-3" style="text-align:center">
            <h1 class="mb-0">L'agence <span style="font-style:italic;"> {{ $agencies[0]->title_agency }} </span></h1>
            <button id="showModal" style="width:30%;padding:0.5rem;" type="submit" name="action" value=""
                class="btn btn-dark w-25">Envoyez-nous un message !</button>
        </div>
        <div class="p-3 mb-5" style="max-width: 50%; margin: 0 auto;">
            <p><img class="mt-4" style="width:90%;" src="{{ asset('storage/' . $agencies[0]->photo) }}"></p>
            <p>{{ $agencies[0]->title_agency }} - {{ $agencies[0]->address }} - {{ $agencies[0]->city }}
                <strong>
                    <p>{{ $agencies[0]->description }}</p>
                </strong>

        </div>

        <p><iframe style="width:50%;" {!! $agencies[0]->map !!}> </iframe> </p>


    </div>
    <div id="backdrop" class="backdrop d-none" onclick="closeModal()">
    </div>

    <div id="modal" class="modal">

        <h1 class="mb-3 mt-0"> Envoyez un message à l'agence !</h1>

        <form method="post" action="/contact/agencies/{{ $agencies[0]->id_agency }}" class="w-50 container ">
            @csrf
            <input type="text" hidden value="{{ $agencies[0]->id_agency }}">
            <label for="username">Nom d'utilisateur: </label>
            <input id="username" name="name" type="text" class="form-control"
                value="@if (Auth::check()) {{ Auth::user()->name }} @endif"><br>
            <label for="emailUser">Votre e-mail: </label>
            <input id="emailUser" name="email" type="text" class="form-control"
                value="@if (Auth::check()) {{ Auth::user()->email }} @endif"><br>
            <label for="messageUser">Votre message message: </label>
            <textarea id="messageUser" class="w-100 pb-4 form-control" name="message" type="text" class="w-100 form-control">Bonjour, j'aimerais prendre rendez-vous afin d'avoir plus d'information sur une/des location(s). Cordialement.</textarea>
            <div class="text-center">
                <input type="submit" class="w-50 mt-4 btn btn-primary" value="Envoyer">
            </div>
            @if (!$managers->isEmpty())
                <input type="text" name="id_user" hidden value="{{ $managers[0]->id_user }}">
            @endif

        </form>
    </div>
@endsection
