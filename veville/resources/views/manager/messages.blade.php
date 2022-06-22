@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="flexAnnonces">
            @foreach ($messages as $message)
                <div style="width:45%;border:2px solid black;" class="mt-5 pt-2 p-2 m-1">
                    <p>Envoyé par : {{ $message->name }} - {{ $message->email }}</p>
                    <p>Contenu du message : {{ $message->message }}</p>
                    <p>Envoyé le : {{ $message->created_at }}</p>
                    <a href="mailto:{{ $message->email }}" class="btn btn-dark">Répondre</a>
                </div>
            @endforeach

        </div>
        <div class="container text-center mt-3">
            <a href="/manager/messages/archives/{{ Auth::user()->id }}"><button type="button"
                    class="btn btn-primary w-25">Montrer les messages archivés</button></a>
        </div>
    </div>
@endsection
