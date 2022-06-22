@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-5"> Prenez rendez-vous avec un des agents responsables de l'annonce </h1>

        <form method="post" action="" class="group-form">
            @csrf
            <label for="agentLocation">Agent à contacter: </label>
            <select class=" w-100 form-select mb-3" name="agent_id" id="agentLocation">
                <option hidden>Choisissez un des agents listés ici</option>
                @foreach ($contacts as $contact)
                    <option value="{{ $contact->email }}">{{ $contact->name }}</option>
                @endforeach
            </select>
            <label for="username">Nom d'utilisateur: </label>
            <input id="username" name="name" type="text" class="w-100 form-control"
                value="@if (Auth::check()) {{ Auth::user()->name }} @endif"><br>
            <label for="emailUser">Votre e-mail: </label>
            <input id="emailUser" name="email" type="text" class="w-100 form-control"
                value="@if (Auth::check()) {{ Auth::user()->email }} @endif"><br>
            <label for="messageUser">Votre message: </label>
            <textarea id="messageUser" class="w-100 form-control" name="message" type="text" class="w-100 form-control">Bonjour, je serais intéressé par cet appartement. Cordialement.</textarea>
            <div class="text-center">
                <input type="submit" class="w-50 mt-4 btn btn-primary" value="Envoyer">
            </div>
            <input type="text" hidden value="{{ $contact->id_location }}" name="idLocation">
            <input type="text" hidden value="{{ $contact->id_agency }}" name="idAgency">
        </form>
    </div>
@endsection
