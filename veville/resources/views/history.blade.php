@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        <h2 style="color:green;font-weight:bold;text-align:center;">{{ session('msg') }}</h2><br />
    </div>
    <div class="container">
        <h1 class="text-center">Vos messages envoyés</h1>

        <div class="flexAnnonces">
            @foreach ($messages as $message)
                <div style="width:45%;" class="container mt-5 messages pt-4">
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
    </div>
@endsection
