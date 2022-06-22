@extends('layouts.app')
@section('content')
    <div class=" mt-0 container mt-2">
        <h2 style="color:green;font-weight:bold;text-align:center;">{{ session('msg') }}</h2><br />

        <h1 class="mt-0 mb-0 text-center">Vos messages envoyés</h1>
        @if ($messages->isEmpty())
            <h3 class="mt-3 text-center" style="font-weight:bold;text-decoration: underline;">Pas de messages envoyés pour le
                moment
            </h3>
        @endif

        <div class="flexAnnonces">
            @foreach ($messages as $message)
                <div style="width:45%;" class="mt-5 pt-4">
                    <p><a href="/locations/show/{{ $message->id_location }}"><img
                                style="width: 90%;height:250px;cursor:pointer;"
                                src="{{ Storage::url($message->photo) }}"></a></p>
                    <p>Appartement : {{ $message->title_location }}</p>
                    <p>Description : {{ $message->description }}</p>
                    <p>Envoyé à : {{ $message->email }}</p>
                    <p>Contenu du message : {{ $message->message }}</p>
                    <p>Envoyé le : {{ $message->created_at }}</p>
                </div>
            @endforeach

        </div>
    @endsection
